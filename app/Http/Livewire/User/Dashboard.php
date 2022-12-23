<?php

namespace App\Http\Livewire\User;

use App\Enums\GameResultEnum;
use App\Models\GamePlayer;
use App\Models\User;
use Livewire\Component;

class Dashboard extends Component
{
    public int $win = 0;
    public int $lose = 0;
    public int $pat = 0;
    public int $nul = 0;
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
            if ($userGame->result === GameResultEnum::win) {
                $this->win++;
            } elseif ($userGame->result === GameResultEnum::lose) {
                $this->lose++;
            } elseif ($userGame->result === GameResultEnum::pat) {
                $this->pat++;
            } elseif ($userGame->result === GameResultEnum::nul) {
                $this->nul++;
            }
            elseif ($userGame->result === null) {
                $this->isWaiting++;
            }
            $this->totalGames++;
        }
    }

    public function render()
    {
        return view('livewire.user.dashboard');
    }
}
