<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //tables with references
        DB::table('controls')->delete();
        DB::table('risks')->delete();
        DB::table('periods_consequence_rows')->delete();
        DB::table('periods_probability_rows')->delete();
        DB::table('risks_level_of_threats')->delete();
        DB::table('risks_periods')->delete();
        DB::table('threats')->delete();
        DB::table('vulnerabilities')->delete();
        DB::table('users')->delete();

        $this->call([
            ThreatsSeeder::class,
            VulnerabilitiesSeeder::class,
            UserSeeder::class,
            RiskPeriodsSeeder::class,
            PeriodsConsequenceRowsSeeder::class,
            PeriodsProbabilityRowsSeeder::class,
            PeriodsConsequenceColsSeeder::class,
            PeriodsProbabilityColsSeeder::class,
            RisksLevelOfThreatsSeeder::class,
            RisksSeeder::class,
            ControlsSeeder::class,
        ]);
    }
}
