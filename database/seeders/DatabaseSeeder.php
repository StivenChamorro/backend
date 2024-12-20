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
        DB::table('topics')->delete();
        DB::table('questions')->delete();
        DB::table('answers')->delete();
        DB::table('users')->delete();

        $this->call([
            UserSeeder::class,
        ]);
        
        $this->call([
            TopicSeeder::class,
        ]);

        $this->call([
            QuestionSeeder::class,
        ]);


        $this->call([
            AnswerSeeder::class,
        ]);
    }
}
