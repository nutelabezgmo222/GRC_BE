<?php

namespace App\Http\Service;

use App\Models\User;
use Illuminate\Http\Request;

class AdminService extends Service
{
    public function _GET(Request $request) {
        $users = User::all();

        return [
            'list' => $users
        ];
    }
}
