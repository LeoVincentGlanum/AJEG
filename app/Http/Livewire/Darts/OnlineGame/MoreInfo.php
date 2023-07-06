<?php

namespace App\Http\Livewire\Darts\OnlineGame;

use App\Enums\GameResultEnum;
use App\Models\Bet;
use App\Models\GamePlayer;
use App\Models\Record;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class MoreInfo extends Component
{
    public mixed $info_best_player;
    public int $win_best_player;

    public mixed $info_best_bet;
    public $topGame;
    public $worstGame;
    public $topRound;
    public $worstRound;

    public function mount(){

        $this->topGame = Record::query()->where('type', 'TopGame')->with('user')->orderByDesc('score')->first();
        $this->worstGame = Record::query()->where('type', 'WorstGame')->with('user')->orderBy('score')->first();
        $this->topRound = Record::query()->where('type', 'TopRound')->with('user')->orderByDesc('score')->first();
        $this->worstRound = Record::query()->where('type', 'WorstRound')->with('user')->orderBy('score')->first();


        $this->info_best_player = User::query()->join('ajeg_elo', function ($join) {
            $join->on('ajeg_users.id', '=', 'ajeg_elo.user_id')->where('ajeg_elo.sport_id', 1);
        })->orderBy('ajeg_elo.elo', 'desc')->firstOrFail();

        $userGames = GamePlayer::query()->whereHas('game', function (\Illuminate\Database\Eloquent\Builder $query) {
            $query->where('status','=', 'validate');
        })->where('user_id', $this->info_best_player->id)->get();

        $this->win_best_player = $userGames->where('result', '=', GameResultEnum::Win->value)->count();

        $this->info_best_bet = User::query()
            ->join('ajeg_bets', function ($join) {
                $join->on('ajeg_users.id', '=', 'ajeg_bets.gambler_id')
                    ->where('ajeg_bets.bet_status', 'Win');
            })
            ->select('ajeg_users.*', DB::raw('count(ajeg_bets.id) as wins'))
            ->groupBy('ajeg_users.id')
            ->orderByDesc('wins')
            ->first();
    }

    public function render()
    {
        return view('livewire.darts.onlineGame.more-info');
    }
}
