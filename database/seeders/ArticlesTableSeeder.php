<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class ArticlesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('articles')->insert([
            [
                'name' => 'Artículo 1',
                'description' => 'Descripción del artículo 1',
                'price' => 100.00,
                'avatar' => 'avatar1.jpg',
                'store_id' => 1,  // ID de una tienda válida
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Artículo 2',
                'description' => 'Descripción del artículo 2',
                'price' => 150.00,
                'avatar' => 'avatar2.jpg',
                'store_id' => 2,  // ID de una tienda válida
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
