<?php

namespace Database\Seeders;

use App\Models\User;
use App\ModelStates\GameStates\Archived;
use App\ModelStates\GameStates\AskAdmin;
use App\ModelStates\GameStates\Cancel;
use App\ModelStates\GameStates\Draft;
use App\ModelStates\GameStates\GameAccepted;
use App\ModelStates\GameStates\InProgress;
use App\ModelStates\GameStatus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class GameSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $players = User::all();
        $gameStatus = GameStatus::all()->toArray();

        foreach ($players as $player) {
            $games = [];

            for ($i = 0; $i < random_int(0, 5); $i++) {
                $games[] = [
                    'label' => $player->name.'\'s Game',
                    'status' => Arr::random($gameStatus),
                    'bet_available' => Arr::random([true, false]),
                ];
            }

            $player->game()->createMany($games);
        }
    }
}
