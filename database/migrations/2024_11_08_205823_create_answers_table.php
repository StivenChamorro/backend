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
        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->string('answer'); // Texto de la opción de respuesta
            $table->enum('option', ['option1', 'option2', 'option3', 'option4']); // Identificar la opción (1, 2, 3, o 4)
            $table->foreignId('question_id')->constrained('questions')->onDelete('cascade'); // Relación con la tabla questions
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('answers');
    }
};
