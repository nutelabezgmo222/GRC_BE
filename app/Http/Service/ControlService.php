<?php

namespace App\Http\Service;

use App\Models\Control;
use App\Models\ControlsResponsible;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ControlService extends Service
{
    public function _GET(Request $request) {
        $controls = Control::with([
            'responsible',
            'createdBy',
        ]);

        return [
            'list' => $controls->get()
        ];
    }

    public function _POST(Request $request) {
        $token = $request->header('Authorization');
        $errors = $this->validateControl($request);
        if(!$token) {
            return response('Token is required', 422);
        }
        if($errors) {
          return response($errors, 422);
        }
        $user = User::where('remember_token', $token)->first();

        $newControl = Control::create([
            'title' => $request['title'],
            'description' => '',
            'expected_evidence' => '',
            'deadline' => date("Y-m-d H:i:s"),
            'creation_date' => date("Y-m-d H:i:s"),
            'created_by' => $user->id,
        ]);

        foreach($request['responsibles'] as $responsibleId) {
            ControlsResponsible::create([
                'cntrl_id' => $newControl->id,
                'u_id' => $responsibleId
            ]);
        }

        return $this->findWith($newControl->id);
    }

    public function _GET_control_by_id($id) {
        $control = Control::with([
            'responsible',
            'createdBy',
        ])->where('id', '=', $id)->first();

        return [ 'data' => $control ];
    }

    public function _PATCH($id, Request $request) {
        $errors = $this->validateControl($request);

        if($errors) {
            return response($errors, 422);
        }

        $controlToPatch = Control::find(intval($id));

        if(!$controlToPatch) {
            return response('Control not found', 422);
        }
        $requestData = $request->all();

        $controlToPatch->fill($requestData)->save();

        return $controlToPatch;
    }

    public function _DELETE($id) {
        $controlToDelete = Control::find(intval($id));

        if(!$controlToDelete) {
            return response('Item not found', 422);
        }

        return $controlToDelete->delete();
    }

    public function validateControl(Request $request) {
        $validationRules = [
            'title' => ['max:200'],
        ];
        
        return $this->validateRequest($request, $validationRules);
    }

    public function findWith($id) {
        return Control::with([
            'responsible',
            'createdBy',
        ])->find($id);
    }
}
