<?php

namespace App\Http\Service;

use App\Models\Risk;
use App\Models\RisksResponsible;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class RiskService extends Service
{
    public function _GET(Request $request) {
        $risks = Risk::with([
            'responsible',
            'threats',
            'vulnerabilities',
            'risksPeriod',
            'riskThreatLevel',
            'createdBy',
            'approvedBy'
        ]);

        return [
            'list' => $risks->get()
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

    public function _GET_risk_by_id($id) {
        $risk = Risk::with([
            'responsible',
            'threats',
            'vulnerabilities',
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
            return response('Risk not found', 422);
        }
        $requestData = $request->all();

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
            'threats',
            'vulnerabilities',
            'risksPeriod',
            'riskThreatLevel',
            'createdBy',
            'approvedBy'
        ])->find($id);
    }
}
