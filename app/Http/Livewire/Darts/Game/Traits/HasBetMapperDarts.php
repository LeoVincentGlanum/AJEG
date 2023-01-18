<?php

namespace App\Http\Livewire\Darts\Game\Traits;

use App\Models\Bet;
use App\Models\GamePlayer;
use App\Models\User;

trait HasBetMapperDarts
{
    protected function cashOutAllGambler(): void
    {
        $allBet = Bet::query()->where('game_id', $this->currentGame->id)->get();
        collect($allBet)
            ->map(function ($bet) {
                return User::query()->where('id', $bet->gambler_id)->increment('coins', $bet->bet_deposit);
            });
    }

    protected function calcBetRatio($users): void
    {
        $player1 = $users[0];
        $player2 = $users[1];

        $ratioWeaker = ($player1->elo_darts / $player2->elo_darts) + 1;
        $ratioStronger = ($player2->elo_darts / $player1->elo_darts) + 1;

        GamePlayer::query()->where('user_id', $player1->id)->update(['bet_ratio' => $ratioStronger]);
        GamePlayer::query()->where('user_id', $player2->id)->update(['bet_ratio' => $ratioWeaker]);
    }
}
