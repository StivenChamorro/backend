<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'User',
            'last_name' => 'Admin',
            'pic_profile' => '', // Aquí puedes poner la URL de la imagen
            'birthdate' => '1990-01-01',
            'email' => 'user.admin@gmail.com',
            'user' => 'adminn123', // Un nombre de usuario único
            'password' => bcrypt('123456789'), // Contraseña cifrada
            'role' => 'admin', // Puedes cambiar el rol si es necesario
            'email_verified_at' => now(), // Si necesitas marcar el correo como verificado
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
