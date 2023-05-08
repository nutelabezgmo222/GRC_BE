<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = ['Michael', 'Nick', 'Brain', 'Lusiya', 'Masha', 'Margarita', 'Nicolai', 'Jojo', 'Kille'];
        $surnames = ['Elsher', 'Solace', 'Solace', 'Thatcher', 'Raven', 'Bardot', 'Hansley', 'Cromwell', 'Ashley'];
        $usersToCreate = 20;
        $id = 1;

        DB::table('users')->insert([
            'id' => $id,
            'u_name' => 'Maxim',
            'u_surname' => 'Solod',
            'u_email' => 'test@i.ua',
            'u_password' => '1234',
            'u_registration_date' => date("Y-m-d H:i:s"),
            'last_log_time' => date("Y-m-d H:i:s"),
            'is_admin' => 1,
            'r_access_level' => 4,
            'cntrl_access_level' => 4,
        ]);

        $id = $id + 1;

        for($i = 0; $i < $usersToCreate; $i++) {
            DB::table('users')->insert([
                'id' => $id,
                'u_name' => $names[rand(0, 8)],
                'u_surname' => $surnames[rand(0, 8)],
                'u_email' => Str::random(10).'@gmail.com',
                'u_password' => Hash::make('password'),
                'u_registration_date' => date("Y-m-d H:i:s"),
                'last_log_time' => date("Y-m-d H:i:s"),
                'is_admin' => 0,
                'r_access_level' => $id % 4,
                'cntrl_access_level' => $id % 4,
            ]);
            
            $id = $id + 1;
        }
    }
}