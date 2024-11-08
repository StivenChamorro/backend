<?php

namespace Database\Factories;

use App\Models\Topic;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Level>
 */
class LevelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,                          // Nombre aleatorio para el nivel
            'score' => $this->faker->numberBetween(50, 100),        // Puntaje entre 50 y 100
            'topic_id' => Topic::inRandomOrder()->first()->id,      // ID de un topic aleatorio existente
        ];
    }
}
