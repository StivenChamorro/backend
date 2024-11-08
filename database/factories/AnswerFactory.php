<?php

namespace Database\Factories;

use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Answer>
 */
class AnswerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'answer' => $this->faker->word,                     // Respuesta aleatoria
            'option' => $this->faker->randomElement(['option1', 'option2', 'option3', 'option4']),  // Opción aleatoria
            'question_id' => Question::inRandomOrder()->first()->id,  // ID de una pregunta aleatoria existente
        ];
    }
}
