<?php

namespace App\Http\Livewire\MyAccount;

use App\Models\GamePlayer;
use App\Models\User;
use Livewire\Component;

class Dashboard extends Component
{
    public int $win = 0;
    public int $lose = 0;
    public int $path = 0;
    public int $null = 0;
    public int $isWaiting = 0;
    public int $totalGames = 0;

    public function mount($id){
        $this->id = $id;
        $this->getStat();
    }

    private function getStat()
    {
        $id = $this->id;
        $user = User::query()->where('id',$id)->first();
        $userGames = GamePlayer::query()->where('user_id', $user->id)->get();

        foreach ($userGames as $userGame) {
            if ($userGame->result === 'win') {
                $this->win++;
            } elseif ($userGame->result === 'lose') {
                $this->lose++;
            } elseif ($userGame->result === 'path') {
                $this->path++;
            } elseif ($userGame->result === 'null') {
                $this->null++;
            }
            elseif ($userGame->result === null) {
                $this->isWaiting++;
            }
            $this->totalGames++;
        }
    }

    public function render()
    {
        return view('livewire.my-account.dashboard');
    }
}
