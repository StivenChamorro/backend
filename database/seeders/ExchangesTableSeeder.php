<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class ExchangesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('exchanges')->insert([
            [
                'description' => 'Canje por artículo 1',
                'children_id' => 1,  // ID de un niño válido
                'article_id' => 1,   // ID de un artículo válido
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'description' => 'Canje por artículo 2',
                'children_id' => 2,  // ID de un niño válido
                'article_id' => 2,   // ID de un artículo válido
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}