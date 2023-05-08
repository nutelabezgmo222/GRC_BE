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
}
