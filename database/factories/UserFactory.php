<?php

namespace Database\Factories;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory
 */
class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'password' => Hash::make(Str::random(10)), // password
            'coins' => fake()->randomNumber(),
            'daily_reward' => '2022-10-30 13:23:54',
            'remember_token' => Str::random(10),
        ];
    }

    public function admin(): UserFactory
    {
        return $this->state(function () {
            return [
                'name' => 'Admin',
                'email' => 'admin@glanum.fr',
                'password' => Hash::make('glanum'),
                'coins' => fake()->randomNumber(),
                'daily_reward' => '2022-10-30 13:23:54',
                'admin' => '1',
                'remember_token' => Str::random(10),
            ];
        });
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return Factory
     */
    public function unverified(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
