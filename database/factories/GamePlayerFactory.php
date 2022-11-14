<?php

namespace Database\Factories;

use App\Enums\GameResultEnum;
use App\Models\Game;
use App\Models\User;
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
            'user_id' => User::inRandomOrder()->first()->id,
            'game_id' => Game::inRandomOrder()->first()->id,
            'color' => $this->faker->randomElement(['blanc', 'noir']),
            'result' => $this->faker->randomElement([GameResultEnum::win,
                                                        GameResultEnum::lose,
                                                        GameResultEnum::pat,
                                                        GameResultEnum::nul]),
        ];
    }
}
