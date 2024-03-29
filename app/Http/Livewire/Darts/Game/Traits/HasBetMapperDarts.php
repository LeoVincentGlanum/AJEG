<?php

namespace App\Http\Livewire\Darts\Game\Traits;

use App\Models\Bet;
use App\Models\GamePlayer;
use App\Models\Elo;
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

        $ratioWeaker = (Elo::query()->where('user_id', $users[0]["id"])->where('sport_id', 2)->first()->elo / Elo::query()->where('user_id', $users[1]["id"])->where('sport_id', 2)->first()->elo) + 1;
        $ratioStronger = (Elo::query()->where('user_id', $users[1]["id"])->where('sport_id', 2)->first()->elo / Elo::query()->where('user_id', $users[0]["id"])->where('sport_id', 2)->first()->elo) + 1;

        GamePlayer::query()->where('user_id', $users[0]["id"])->update(['bet_ratio' => $ratioStronger]);
        GamePlayer::query()->where('user_id', $users[1]["id"])->update(['bet_ratio' => $ratioWeaker]);
    }
}
