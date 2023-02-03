<?php

namespace App\Http\Livewire\Chess\Game;

use App\Models\User;
use Livewire\Component;

class UserRankChess extends Component
{
    public int $rank;
    public  User $user;
    public $devise;

    public function mount(User $user,$rank,$devise = null)
    {
        $this->user = $user;
        $this->rank = $rank;
        $this->devise = $devise;
    }


    public function render()
    {
        return view('livewire.chess.game.user-rank-chess');
    }
}
