<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('level_completions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('children_id')->references('id')->on('childrens')->onDelete('cascade'); // Asocia el niño
            $table->foreignId('level_id')->references('id')->on('levels')->onDelete('cascade'); // Asocia el nivel
            $table->enum('status', ['completed', 'not_completed'])->default('not_completed'); // El estado de completado
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('level_completions');
    }
};
