<?php

namespace Database\Factories;

use App\Models\Exchange;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ImageUser>
 */
class ImageUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'exchange_id' => Exchange::inRandomOrder()->first()->id,  // ID de un intercambio aleatorio
        ];
    }
}
