<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeriodsConsequenceRowsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $id = 1;
        $rows = ['Confidentiality', 'Integrity', 'Availability'];

        foreach($rows as $row) {
            DB::table('periods_consequence_rows')->insert([
                'id' => $id,
                'label' => $row,
                'rsk_per_id' => 1,
            ]);

            $id = $id + 1;
        }
    }
}
