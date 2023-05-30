<?php

namespace App\Http\Service;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class UsersService extends Service
{
    public function _GET(Request $request) {
        $users = User::all();

        return [
            'list' => $users
        ];
    }

    public function _POST(Request $request) {
        $token = $request->header('Authorization');
        $errors = $this->validateUser($request);
        if(!$token) {
            return response('Token is required', 422);
        }
        if($errors) {
          return response($errors, 422);
        }
        $user = User::where('remember_token', $token)->first();

        $newUser = User::create([
            'u_name' => $request['u_name'],
            'u_surname' => $request['u_surname'],
            'u_email' => $request['u_email'],
            'u_password' => $request['u_password'],
            'u_registration_date' => date("Y-m-d"),
            'last_log_time' => date("Y-m-d H:i:s"),
            'is_admin' => 0,
            'r_access_level' => 0,
            'cntrl_access_level' => 0,
            'remember_token' => null
        ]);

        return $newUser;
    }

    public function _PATCH($id, Request $request) {
        $errors = $this->validateUser($request, $id);

        if($errors) {
            return response($errors, 422);
        }

        $userToPatch = User::find(intval($id));

        if(!$userToPatch) {
            return response('Control not found', 422);
        }
        $requestData = $request->all();

        $userToPatch->fill($requestData)->save();

        return $userToPatch;
    }

    public function validateUser(Request $request, $id = null) {
        $validationRules = [
            'u_name' => ['max:200', 'min:1'],
            'u_surname' => ['max:200', 'min:1'],
            'u_email' => ['max:100', 'min:1', 'unique:users,u_email'. ($id ? ',' .$id : '')],
        ];
        
        return $this->validateRequest($request, $validationRules);
    }
}
