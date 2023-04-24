<?php

namespace App\Http\Service;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegistryService extends Service
{
    public function _GET(Request $request) {
        $code = $this->checkIsAdmin($request);

        if($code == 422) {
            return response('Token is required', 422);
        }
        if($code == 404) {
            return response('User not found', 404);
        }
        if($code == 403) {
            return response('You don`t have rights to see this', 403);
        }

        $services = DB::connection('registry')->table('services')->get();

        return [
            'list' => $services
        ];
    }

    public function checkIsAdmin(Request $request) {
        $token = $request->header('Authorization');
        if(!$token) {
            return 422;
        }

        $user = User::where('remember_token', $token)->first();
        if(!$user) {
            return 404;
        }
        if(!$user->is_admin) {
            return 403;
        }

        return 200;
    }
}
