<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RisksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $id = 1;
        $titles = ['Risk title 1', 'Risk title 2', 'Risk title 3'];

        foreach($titles as $title) {
            DB::table('risks')->insert([
                'id' => $id,
                'title' => $title,
                'description' => 'Description text',
                'status' => 'Status text',
                'thr_comment' => 'Threat comment',
                'thr_lvl_comment' => 'Threat level comment',
                'vul_comment' => 'Vulnerability comment',
                'approve_date' => date("Y-m-d H:i:s"),
                'approved_by' => 1,
                'creation_date' => date("Y-m-d H:i:s"),
                'created_by' => 1,
                'rsk_per_id' => 1,
                'thr_lvl_id' => 1
            ]);

            $id = $id + 1;
        }
    }
}
