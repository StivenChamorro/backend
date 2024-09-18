<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class ChildrensTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('childrens')->insert([
            [
                'name' => 'Niño 1',
                'age' => 8,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Niña 2',
                'age' => 9,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
