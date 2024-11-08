<?php

namespace Database\Seeders;

use App\Models\Exchange;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ImageUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create(); // Crear una instancia de Faker

        // Obtener IDs de la tabla exchanges para usarlos en los registros de image_users
        $exchangeIds = Exchange::pluck('id')->toArray();

        // Insertar registros de prueba
        foreach (range(1, 10) as $index) {
            DB::table('image_users')->insert([
                'exchange_id' => $faker->randomElement($exchangeIds), // Asigna un exchange_id aleatorio existente
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
