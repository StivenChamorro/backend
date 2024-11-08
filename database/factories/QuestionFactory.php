<?php

namespace Database\Factories;

use App\Models\Level;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'question' => $this->faker->sentence,                 // Pregunta aleatoria
            'score' => $this->faker->numberBetween(50, 100),      // Puntaje entre 50 y 100
            'correct_answer' => $this->faker->word,               // Respuesta correcta aleatoria
            'clue' => $this->faker->sentence,                     // Pista aleatoria
            'level_id' => Level::inRandomOrder()->first()->id,    // ID de nivel aleatorio existente
        ];
    }
}
