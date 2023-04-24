<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VulnerabilitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $id = 1;
        $vulnerabilities = ['Misplaced Trust', 'Missing internal documentation', 'Non-documented software',
            'Passwords not changed', 'Non-compliance with policies and procedures'];

        foreach($vulnerabilities as $vulnerability) {
            DB::table('vulnerabilities')->insert([
                'vul_id' => $id,
                'vul_title' => $vulnerability
            ]);

            $id = $id + 1;
        }
    }
}
