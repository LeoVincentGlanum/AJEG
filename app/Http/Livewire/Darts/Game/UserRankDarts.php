<?php

namespace App\Http\Livewire\Darts\Game;

use App\Models\User;
use Livewire\Component;

class UserRankDarts extends Component
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
        return view('livewire.darts.game.user-rank-darts');
    }
}
