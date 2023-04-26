<?php

namespace App\Http\Livewire\Darts\OnlineGame;

use App\Models\Record;
use Illuminate\Http\Request;

use Livewire\Component;

class Board extends Component
{
    public function render()
    {
        return view('livewire.darts.onlineGame.board');
    }
}
