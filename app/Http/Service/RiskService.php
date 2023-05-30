<?php

namespace App\Http\Service;

use App\Models\Risk;
use App\Models\RisksResponsible;
use App\Models\RisksThreat;
use App\Models\RisksVulnerability;
use App\Models\User;
use App\Models\Threat;
use App\Models\Vulnerability;
use App\Models\RisksLevelOfThreats;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class RiskService extends Service
{
    public function _GET(Request $request) {
        $risks = Risk::with([
            'responsible',
            'risksPeriod',
            'riskThreatLevel',
            'createdBy',
            'approvedBy'
        ]);

        return [
            'list' => $risks->get()
        ];
    }

    public function _GET_risk_attributes(Request $request) {
        $threats = Threat::all();
        $vulnerabilities = Vulnerability::all();
        $levelOfThreats = RisksLevelOfThreats::all();

        return [
            'threats' => $threats,
            'vulnerabilities' => $vulnerabilities,
            'levelOfThreats' => $levelOfThreats,
        ];
    }

    public function _POST(Request $request) {
        $token = $request->header('Authorization');
        $errors = $this->validateRisk($request);
        if(!$token) {
            return response('Token is required', 422);
        }
        if($errors) {
          return response($errors, 422);
        }
        $user = User::where('remember_token', $token)->first();
        if(!$user) {
            return response('Authorization failed', 422);
        }

        $newRisk = Risk::create([
            'title' => $request['title'],
            'description' => '',
            'status' => '',
            'thr_comment' => '',
            'thr_lvl_comment' => '',
            'vul_comment' => '',
            'approve_date' => null,
            'approved_by' => null,
            'creation_date' => date("Y-m-d H:i:s"),
            'created_by' => $user->id,
            'rsk_per_id' => 1,
            'thr_lvl_id' => 1,
        ]);

        foreach($request['responsibles'] as $responsibleId) {
            RisksResponsible::create([
                'rsk_id' => $newRisk->id,
                'u_id' => $responsibleId
            ]);
        }

        return $this->findWith($newRisk->id);
    }

    public function _POST_risk_attributes(Request $request) {
        $token = $request->header('Authorization');
        if(!$token) {
            return response('Token is required', 422);
        }
        $user = User::where('remember_token', $token)->first();
        if(!$user) {
            return response('Authorization failed', 422);
        }

        $newItem = null;
        switch($request['type']) {
            case 'threats': 
                $newItem = Threat::create(['title' => $request['title']]);
                break;
            case 'vulnerabilities': 
                $newItem = Vulnerability::create(['title' => $request['title']]);
                break;
            case 'level_of_threats':
                $newItem = RisksLevelOfThreats::create(['title' => $request['title']]);
                break;
        }
        $newItem->type = $request['type'];

        return $newItem;
    }

    public function _PATCH_risk_attributes($id, $type, Request $request) {
        $token = $request->header('Authorization');
        if(!$token) {
            return response('Token is required', 422);
        }
        $user = User::where('remember_token', $token)->first();
        if(!$user) {
            return response('Authorization failed', 422);
        }

        $itemToPatch = null;
        switch($type) {
            case 'threats': 
                $itemToPatch = Threat::find(intval($id));
                break;
            case 'vulnerabilities': 
                $itemToPatch = Vulnerability::find(intval($id));
                break;
            case 'level_of_threats':
                $itemToPatch = RisksLevelOfThreats::find(intval($id));
                break;
        }
        if(!$itemToPatch) {
            return response('Item wasn`t found', 422);
        }

        $itemToPatch->fill($request->all())->save();
        $itemToPatch->type = $type;
        return $itemToPatch;
    }

    public function _DELETE_risk_attributes($id, $type, Request $request) {
        $token = $request->header('Authorization');
        if(!$token) {
            return response('Token is required', 422);
        }
        $user = User::where('remember_token', $token)->first();
        if(!$user) {
            return response('Authorization failed', 422);
        }

        $itemToDelete = null;
        switch($type) {
            case 'threats': 
                $itemToDelete = Threat::find(intval($id));
                break;
            case 'vulnerabilities': 
                $itemToDelete = Vulnerability::find(intval($id));
                break;
            case 'level_of_threats':
                $itemToDelete = RisksLevelOfThreats::find(intval($id));
                break;
        }
        if(!$itemToDelete) {
            return response('Item wasn`t found', 422);
        }
        return $itemToDelete->delete();
    }

    public function _GET_risk_by_id($id) {
        $risk = Risk::with([
            'responsible',
            'risksPeriod',
            'riskThreatLevel',
            'createdBy',
            'approvedBy'
        ])->where('id', '=', $id)->first();

        return [ 'data' => $risk ];
    }

    public function _PATCH($id, Request $request) {
        $errors = $this->validateRisk($request);

        if($errors) {
            return response($errors, 422);
        }

        $riskToPatch = Risk::find(intval($id));

        if(!$riskToPatch) {
            return response('Risk wasn`t found', 422);
        }
        $requestData = $request->all();

        if ($request->exists('threat_ids')) {
            RisksThreat::where('rsk_id', $id)
                ->delete();

            foreach($request['threat_ids'] as $threatId) {
                RisksThreat::create([
                    'rsk_id' => $id,
                    'thr_id' => $threatId
                ]);
            }
        }

        if ($request->exists('vulnerability_ids')) {
            RisksVulnerability::where('rsk_id', $id)
                ->delete();

            foreach($request['vulnerability_ids'] as $vulnerabilityId) {
                RisksVulnerability::create([
                    'rsk_id' => $id,
                    'vul_id' => $vulnerabilityId
                ]);
            }
        }

        $riskToPatch->fill($requestData)->save();

        return $riskToPatch;
    }

    public function _DELETE($id) {
        $toyToDelete = Toy::find(intval($id));

        if(!$toyToPatch) {
            return response('Item not found', 422);
        }

        return $toyToDelete->delete();
    }

    public function validateRisk(Request $request) {
        $validationRules = [
            'title' => ['max:200'],
        ];
        
        return $this->validateRequest($request, $validationRules);
    }

    public function findWith($id) {
        return Risk::with([
            'responsible',
            'risksPeriod',
            'riskThreatLevel',
            'createdBy',
            'approvedBy'
        ])->find($id);
    }
}
