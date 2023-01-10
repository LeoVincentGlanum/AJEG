<?php

namespace App\Http\Livewire\Game\Traits;

use App\Models\Bet;
use App\Models\GamePlayer;
use App\Models\User;

trait HasBetMapper
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

        $ratioWeaker = ($player1->elo / $player2->elo) + 1;
        $ratioStronger = ($player2->elo / $player1->elo) + 1;

        GamePlayer::query()->where('user_id', $player1->id)->update(['bet_ratio' => $ratioStronger]);
        GamePlayer::query()->where('user_id', $player2->id)->update(['bet_ratio' => $ratioWeaker]);
    }
}
