<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Games>
 */
class GamesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_1_id' => fake()->id(),
            'user_2_id' => fake()->id(),
            'is_null' => fake()->boolean(),
        ];
    }
}
