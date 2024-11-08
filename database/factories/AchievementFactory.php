<?php

namespace Database\Factories;

use App\Models\Children;
use App\Models\Level;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Achievement>
 */
class AchievementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,                             // Nombre aleatorio para el logro
            'description' => $this->faker->sentence,                   // Descripción aleatoria
            'reward' => $this->faker->numberBetween(10, 100),          // Recompensa aleatoria
            'children_id' => Children::inRandomOrder()->first()->id,   // ID de un niño aleatorio existente
            'level_id' => Level::inRandomOrder()->first()->id,         // ID de un nivel aleatorio existente
            'status' => 'blocked',                                     // Estado inicial (bloqueado)
        ];
    }
}
