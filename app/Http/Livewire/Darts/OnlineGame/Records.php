<?php

namespace App\Http\Livewire\Darts\OnlineGame;

use App\Models\Game;
use App\Models\Record;
use App\ModelStates\GameStates\GameAccepted;
use App\ModelStates\GameStates\PlayersValidation;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Livewire\Component;

class Records extends Component
{
    public $records;
    public $score = 0;
    public $topRound;
    public $worstRound;
    public $worstGame;
    public $topGame;

    protected $listeners = ['recordsChanged' => 'refreshRecords'];

    public function hit($value)
    {
        $this->score += $value;
    }

    public function refreshRecords() {
        $this->records = Record::query()->get();
    }

    public function mount()
    {
        $this->topRound = Record::query()->where('type', 'TopRound')->orderByDesc('score')->limit(1)->first();
        $this->worstRound = Record::query()->where('type', 'WorstRound')->orderBy('score')->limit(1)->first();
        $this->worstGame = Record::query()->where('type', 'WorstGame')->orderBy('score')->limit(1)->first();
        $this->topGame = Record::query()->where('type', 'TopGame')->orderByDesc('score')->limit(1)->first();

        $this->records = collect([
            $this->topRound,
            $this->worstRound,
            $this->worstGame,
            $this->topGame,
        ]);
    }

    public function render()
    {
        return view('livewire.darts.onlineGame.records');
    }
}
