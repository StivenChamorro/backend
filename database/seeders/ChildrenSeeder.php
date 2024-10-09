<?php

namespace Database\Seeders;
use App\Models\Children;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChildrenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Children::factory(10)->create(); // Crea 10 registros en la tabla 'childrens'
    }
}
