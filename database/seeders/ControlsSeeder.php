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
                'title' => $title,
                'deadline' => '2024-04-24 12:00:00',
                'description' => 'Description text',
                'expected_evidence' => 'Expected evidence comment',
                'created_by' => 1,
                'creation_date' => date("Y-m-d H:i:s"),
            ]);

            $id = $id + 1;
        }
    }
}
