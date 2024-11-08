<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Topic>
 */
class TopicFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,                              // Nombre aleatorio
            'image' => $this->faker->imageUrl(640, 480, 'topics'),     // URL de imagen aleatoria
            'description' => $this->faker->sentence,                   // Descripción aleatoria
        ];
    }
}
