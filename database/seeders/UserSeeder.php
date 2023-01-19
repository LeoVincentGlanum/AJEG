<?php

namespace Database\Seeders;

use App\Models\Elo;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(1)->admin()->has(Elo::factory()->count(2)->state(new Sequence(
                    ['sport_id' => '1'],
                    ['sport_id' => '2'],
                )))->create();

        User::factory()
            ->count(50)
            ->has(
                Transaction::factory()
                ->count(4)
            )
            ->has(Elo::factory()->count(2)->state(new Sequence(
                    ['sport_id' => '1'],
                    ['sport_id' => '2'],
                )))
            ->create();
    }
}
