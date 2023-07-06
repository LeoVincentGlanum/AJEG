<?php

namespace App\Http\Livewire\Chess\Game\Traits;

use App\Models\Bet;
use App\Models\GamePlayer;
use App\Models\Elo;
use App\Models\User;

trait HasBetMapperChess
{
    protected function cashOutAllGambler(): void
    {
        $allBet = Bet::query()->where('game_id', $this->currentGame->id)->get();
        collect($allBet)
            ->map(function ($bet) {
                return User::query()->where('id', $bet->gambler_id)->increment('coins', $bet->bet_deposit);
            });
    }

    protected function calcBetRatio(array $users): void
    {
        $player1 = $users[0];
        $player2 = $users[1];
        $player1LastElo = Elo::query()
                                ->where('user_id', $player1['user_id'])
                                ->where('sport_id', 1)
                                ->latest('updated_at')
                                ->first()
                                ->elo;
        $player2LastElo = Elo::query()
                                ->where('user_id', $player2['user_id'])
                                ->where('sport_id', 1)
                                ->latest('updated_at')
                                ->first()
                                ->elo;

        $ratioWeaker = ($player1LastElo / $player2LastElo) + 1;
        $ratioStronger = ($player2LastElo / $player1LastElo) + 1;

        GamePlayer::query()->where('user_id', $player1["id"])->update(['bet_ratio' => $ratioStronger]);
        GamePlayer::query()->where('user_id', $player2["id"])->update(['bet_ratio' => $ratioWeaker]);
    }
}
