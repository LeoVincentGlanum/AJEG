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
        $this->records = Record::query()->get();
    }

    public function render()
    {
        return view('livewire.darts.onlineGame.records');
    }
}
