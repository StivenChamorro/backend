<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->timestamps();
        });
        DB::table('stores')->insert([
            ['name' => 'Tienda 1' , 'description' => 'Hola desde tienda 1'],
            ['name' => 'Tienda 2' , 'description' => 'Hola desde tienda 2'],
            ['name' => 'Tienda 3' , 'description' => 'Hola desde tienda 3'],
            ['name' => 'Tienda 4' , 'description' => 'Hola desde tienda 4'],
            ['name' => 'Tienda 5' , 'description' => 'Hola desde tienda 5']
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stores');
    }
};
