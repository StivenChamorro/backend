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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->integer('score');
            $table->string('correct_answer');
            $table->string('clue'); // agregamos como nuevo campo, clue(pista) 
            $table->foreignId('level_id')->references('id')->on('levels')->onDelete('cascade');// Y agregamos como llave foranea topic(tema) a question
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
