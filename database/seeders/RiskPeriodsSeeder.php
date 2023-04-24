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
            'rsk_per_title' => 'Quartal 1',
            'rsk_per_probability_title' => 'Probability',
            'rsk_per_consequence_title' => 'Consequence',
        ]);
    }
}
