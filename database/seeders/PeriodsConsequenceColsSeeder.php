<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeriodsConsequenceColsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $id = 1;
        $cols = ['Minor', 'Less serious', 'Serious', 'Very serious', 'Grave'];
        $rowId = 1;

        while($rowId < 4) {
            $colNum = 1;

            foreach($cols as $col) {
                DB::table('periods_consequence_cols')->insert([
                    'per_cons_col_id' => $id,
                    'per_cons_col_title' => $col,
                    'per_cons_col_num' => $colNum,
                    'per_cons_row_id' => $rowId
                ]);
    
                $id = $id + 1;
                $colNum = $colNum + 1;
            }

            $rowId = $rowId + 1;
        }
    }
}