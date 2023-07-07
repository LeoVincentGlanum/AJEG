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
    }

    public function render()
    {
        return view('livewire.darts.onlineGame.more-info');
    }
}
