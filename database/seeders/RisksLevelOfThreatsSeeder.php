<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RisksLevelOfThreatsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $id = 1;
        $rows = ['Low', 'Medium', 'High', 'Major'];

        foreach($rows as $row) {
            DB::table('risks_level_of_threats')->insert([
                'rsk_thr_lvl_id' => $id,
                'rsk_per_id' => 1,
                'rsk_thr_lvl_option' => $row,
            ]);

            $id = $id + 1;
        }
    }
}