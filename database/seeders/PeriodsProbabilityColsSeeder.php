<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeriodsProbabilityColsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $id = 1;
        $cols = ['Unlikely', 'Less unlikely', 'Likely', 'Very likely'];
        $rowId = 1;

        while($rowId < 4) {
            $colNum = 1;

            foreach($cols as $col) {
                DB::table('periods_probability_cols')->insert([
                    'id' => $id,
                    'per_prob_col_title' => $col,
                    'per_prob_col_num' => $colNum,
                    'per_prob_row_id' => $rowId
                ]);
    
                $id = $id + 1;
                $colNum = $colNum + 1;
            }

            $rowId = $rowId + 1;
        }
    }
}
