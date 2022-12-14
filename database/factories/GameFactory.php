<?php

namespace Database\Factories;

use App\Enums\GameStatusEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Game>
 */
class GameFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'status' => $this->faker->randomElement([GameStatusEnum::progress,
                                                        GameStatusEnum::waiting,
                                                        GameStatusEnum::ended]),
            'created_by' => \App\Models\User::inRandomOrder()->first()->id,
        ];
    }
}
