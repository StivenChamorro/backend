<?php

namespace Database\Factories;

use App\Models\Children;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Children>
 */
class ChildrenFactory extends Factory
{
    protected $model = Children::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->firstName(),
            'lastname' => $this->faker->lastName(),
            'birthdate' => $this->faker->dateTimeBetween('-11 years', '-5 years'),
            'nickname' => $this->faker->userName(),
            'relation' => $this->faker->randomElement(['hijo', 'hija', 'sobrino', 'sobrina']), // Relación opcional.
            'avatar' => $this->faker->imageUrl(200, 200, 'avatar'), // URL aleatoria para avatar.
            'gender' => $this->faker->randomElement(['male', 'female', 'non-binary']), // Género.
            'user_id' => User::factory(), // Crea un usuario asociado.
        ];
    }
}
