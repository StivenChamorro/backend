<?php

namespace Database\Factories;

use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,                         // Nombre del artículo
            'description' => $this->faker->sentence,              // Descripción del artículo
            'price' => $this->faker->randomFloat(2, 1, 1000),    // Precio entre 1 y 1000
            'avatar' => $this->faker->imageUrl(200, 200, 'product'), // URL ficticia de imagen
            'type' => $this->faker->randomElement(['Type A', 'Type B', 'Type C']), // Tipo del artículo
            'store_id' => Store::inRandomOrder()->first()->id,   // ID de tienda aleatoria existente
        ];
    }
}
