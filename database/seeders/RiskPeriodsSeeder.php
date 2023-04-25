<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RiskPeriodsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('risks_periods')->insert([
            'id' => 1,
            'title' => 'Quartal 1',
            'probability_title' => 'Probability',
            'consequence_title' => 'Consequence',
        ]);
    }
}
