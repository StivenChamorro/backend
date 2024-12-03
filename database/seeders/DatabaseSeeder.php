<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        /*User::factory()->create([
            'name' => 'Test User',
            'last_name' => 'Doe', 
            'age' => '25',
            'email' => 'test@example.com',
            'user' => 'xxx@example.com',
            'password' => '123456789',
            'pin' => '1234'
        ]);*/

          // Vaciar las tablas antes de insertar datos
        DB::table('answers')->truncate();
        DB::table('questions')->truncate();

        $this->call([
            QuestionSeeder::class,
            AnswerSeeder::class,
        ]);
    }
}
