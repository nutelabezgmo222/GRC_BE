<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ControlsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $id = 1;
        $titles = ['Control title 1', 'Control title 2', 'Control title 3'];

        foreach($titles as $title) {
            DB::table('controls')->insert([
                'id' => $id,
                'cntrl_title' => $title,
                'cntrl_deadline' => '2024-04-24 12:00:00',
                'cntrl_description' => 'Description text',
                'cntrl_expected_evidence' => 'Expected evidence comment',
                'cntrl_created_by' => 1,
                'cntrl_creation_date' => date("Y-m-d H:i:s"),
            ]);

            $id = $id + 1;
        }
    }
}
