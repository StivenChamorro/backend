<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\table;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->string('answer');
            $table->integer('score');
            $table->string('correct_answer');
            $table->string('clue'); // agregamos como nuevo campo, clue(pista) 
            $table->foreignId('topic_id')->references('id')->on('topics')->onDelete('cascade'); // Y agregamos como llave foranea topic(tema) a question
            $table->timestamps();
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
