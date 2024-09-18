<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class StoresTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('stores')->insert([
            [
                'name' => 'Tienda Principal',
                'description' => 'La tienda principal de la ciudad',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Sucursal Norte',
                'description' => 'Sucursal en la zona norte',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
