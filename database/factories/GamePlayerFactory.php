<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GamePlayer>
 */
class GamePlayerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        return [
            'user_id' => \App\Models\User::inRandomOrder()->first()->id,
            'game_id' => \App\Models\Game::inRandomOrder()->first()->id,
            'color' => $this->faker->randomElement(['blanc', 'noir']),
            'result' => $this->faker->randomElement(['win', 'lose', 'pat', 'nul']),
        ];
    }
}
