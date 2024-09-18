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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->double('price');
            $table->string('avatar');
            $table->foreignId('store_id')->references('id')->on('stores')->onDelete('cascade');
            $table->timestamps();
        });
        DB::table('articles')->insert([
            ['name' => 'Tienda 1' , 'description' => 'Hola desde tienda 1',
            'price' => '100' , 'avatar' => 'Hola', 'store_id' => 1]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
