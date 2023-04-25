<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ThreatsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $id = 1;
        $threats = ['Hacking', 'Network errors', 'Software errors', 'Strike', 'Terror Attack', 'User errors'];

        foreach($threats as $threat) {
            DB::table('threats')->insert([
                'id' => $id,
                'title' => $threat
            ]);

            $id = $id + 1;
        }
    }
} 
