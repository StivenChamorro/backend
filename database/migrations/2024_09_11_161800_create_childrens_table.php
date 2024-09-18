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
        Schema::create('childrens', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            // $table->string('lastname');
            $table->string('age');
            // $table->string('nickname');
            // $table->string('relation')->nullable();
            // $table->string('avatar')->nullable();
            // $table->string('gender')->nullable();
            // $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
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

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('childrens');
    }
};
