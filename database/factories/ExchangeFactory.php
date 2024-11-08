<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\Children;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Exchange>
 */
class ExchangeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
           'description' => $this->faker->sentence,                    // Descripción del intercambio
            'children_id' => Children::inRandomOrder()->first()->id,    // ID de un niño aleatorio
            'article_id' => Article::inRandomOrder()->first()->id,      // ID de un artículo aleatorio
        ];
    }
}
