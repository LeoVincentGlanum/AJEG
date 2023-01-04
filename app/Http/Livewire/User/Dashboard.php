<?php

namespace App\Http\Livewire\User;

use App\Enums\GameResultEnum;
use App\Http\Livewire\Traits\HasToast;
use App\Models\GamePlayer;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Dashboard extends Component
{
    use HasToast;

    public User $user;

    public int $win = 0;

    public int $lose = 0;

    public int $pat = 0;

    public int $nul = 0;

    public int $inStandby = 0;

    public int $totalGames = 0;

    public function mount(User $user){
        try {
            $this->user = $user;
            $this->getStat();
        } catch (\Throwable $e) {
            Log::error($e->getMessage());
            $this->errorToast(__('An error occurred while retrieving statistics'));
        }
    }

    private function getStat()
    {

        $userGames = GamePlayer::query()->whereHas('game', function (\Illuminate\Database\Eloquent\Builder $query) {
            $query->where('status','=', 'validate');
        })->where('user_id', $this->user->id)->get();
        $this->win = $userGames->where('result', '=', GameResultEnum::win)->count();
        $this->lose = $userGames->where('result', '=', GameResultEnum::lose)->count();
        $this->pat = $userGames->where('result', '=', GameResultEnum::pat)->count();
        $this->nul = $userGames->where('result', '=', GameResultEnum::nul)->count();
        $this->inStandby = $userGames->where('result', '=', null)->count();
        $this->totalGames = $this->win + $this->lose+ $this->pat+$this->nul+$this->inStandby;


        $this->totalGames = $userGames->count();
    }

    public function render()
    {
        return view('livewire.user.dashboard');
    }
}
