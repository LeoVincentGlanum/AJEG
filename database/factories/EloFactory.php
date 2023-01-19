<?php

namespace Database\Factories;

use App\Models\Elo;
use Illuminate\Database\Eloquent\Factories\Factory;

class EloFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Elo::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'elo' => 500,
        ];
    }
}
