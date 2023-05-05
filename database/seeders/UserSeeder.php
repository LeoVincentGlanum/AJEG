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
        User::factory(1)
            ->admin()
            ->has(
                Elo::factory(2)
                    ->state(new Sequence(
                        ['sport_id' => '1'],
                        ['sport_id' => '2'],
                    ))
            )
            ->create();

        User::factory(1)
            ->gaelGlanum()
            ->has(
                Elo::factory(2)
                    ->state(new Sequence(
                        ['sport_id' => '1'],
                        ['sport_id' => '2'],
                    ))
            )
            ->create();

        User::factory(1)
            ->adrienGlanum()
            ->has(
                Elo::factory(2)
                    ->state(new Sequence(
                        ['sport_id' => '1'],
                        ['sport_id' => '2'],
                    ))
            )
            ->create();

        User::factory(1)
            ->matthiasGlanum()
            ->has(
                Elo::factory(2)
                    ->state(new Sequence(
                        ['sport_id' => '1'],
                        ['sport_id' => '2'],
                    ))
            )
            ->create();

        User::factory(1)
            ->cyrilGlanum()
            ->has(
                Elo::factory(2)
                    ->state(new Sequence(
                        ['sport_id' => '1'],
                        ['sport_id' => '2'],
                    ))
            )
            ->create();

        User::factory(1)
            ->ellaGlanum()
            ->has(
                Elo::factory(2)
                    ->state(new Sequence(
                        ['sport_id' => '1'],
                        ['sport_id' => '2'],
                    ))
            )
            ->create();

        User::factory(1)
            ->tomoGlanum()
            ->has(
                Elo::factory(2)
                    ->state(new Sequence(
                        ['sport_id' => '1'],
                        ['sport_id' => '2'],
                    ))
            )
            ->create();

        User::factory(1)
            ->thibaultGlanum()
            ->has(
                Elo::factory(2)
                    ->state(new Sequence(
                        ['sport_id' => '1'],
                        ['sport_id' => '2'],
                    ))
            )
            ->create();

        User::factory(1)
            ->pierreGlanum()
            ->has(
                Elo::factory(2)
                    ->state(new Sequence(
                        ['sport_id' => '1'],
                        ['sport_id' => '2'],
                    ))
            )
            ->create();

        User::factory(1)
            ->thomasGlanum()
            ->has(
                Elo::factory(2)
                    ->state(new Sequence(
                        ['sport_id' => '1'],
                        ['sport_id' => '2'],
                    ))
            )
            ->create();

        User::factory(1)
            ->leoGlanum()
            ->has(
                Elo::factory(2)
                    ->state(new Sequence(
                        ['sport_id' => '1'],
                        ['sport_id' => '2'],
                    ))
            )
            ->create();

//        User::factory(50)
//            ->has(
//                Transaction::factory(4)
//            )
//            ->has(
//                Elo::factory(2)
//                    ->state(new Sequence(
//                        ['sport_id' => '1'],
//                        ['sport_id' => '2'],
//                    ))
//            )
//            ->create();
    }
}
