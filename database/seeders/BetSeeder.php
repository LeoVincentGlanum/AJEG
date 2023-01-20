<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\User;
use App\ModelStates\BetStates\LooseBet;
use App\ModelStates\BetStates\WinBet;
use App\ModelStates\GamePlayerResultStates\Win;
use App\ModelStates\GameStates\Validate;
use Illuminate\Database\Seeder;

class BetSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $games = Game::query()->where('bet_available', '=', true)->get();
        $gamblers = User::all();

        foreach ($games as $game) {
            $players = $game->gamePlayers;
            $bets = [];
            $playersId = $players->pluck('id');

            for ($i=0; $i < random_int(0, 4); $i++) {
                $gambler = $gamblers->whereNotIn('id', $playersId)->random(1)->first();
                $playersId[] = $gambler->id;

                $gamePlayer = $players->random(1)->first();

                $deposit = random_int(1, 500);
                $gain = $deposit * $gamePlayer->bet_ratio;

                $status = null;
                if ($game->status->equals(Validate::class)) {
                    if ($gamePlayer->result->equals(Win::class)) {
                        $status = WinBet::class;
                    } else {
                        $status = LooseBet::class;
                    }
                }

                $bets[] = [
                    'gambler_id' => $gambler->id,
                    'gameplayer_id' => $gamePlayer->id,
                    'bet_deposit' => $deposit,
                    'bet_gain' => $gain,
                    'bet_status' => $status,
                ];
            }

            $game->bets()->createMany($bets);
        }
    }
}
