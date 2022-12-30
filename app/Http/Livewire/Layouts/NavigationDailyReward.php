<?php

namespace App\Http\Livewire\Layouts;

use App\Http\Livewire\Traits\HasToast;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class NavigationDailyReward extends Component
{
    use HasToast;

    public bool $isDailyRewardAvailable;

    protected $listeners = ['disableButton'];

    public function mount()
    {
        $this->isDailyRewardAvailable = Auth::user()->isDailyRewardAvailable();
    }

    public function disableButton()
    {
        $this->isDailyRewardAvailable = false;
    }

    public function getDailyReward()
    {
        if ($this->isDailyRewardAvailable === false) {
            return;
        }

        DB::beginTransaction();
        try {
            $user = Auth::user();
            $user->coins = $user->coins + 100;
            $user->daily_reward = now()->timezone('Europe/Paris')->addDays(1);
            $user->save();

            $transaction = new Transaction();
            $transaction->user_id = $user->id;
            $transaction->coins = 100;
            $transaction->message = "Récompense quotidienne";
            $transaction->save();

            DB::commit();
            $this->emitSelf('disableButton');
            $this->successToast('Your daily reward has been collected');
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);
            $this->errorToast('An error occurred while collecting your daily reward');
        }
    }

    public function render()
    {
        return view('livewire.layouts.navigation-daily-reward');
    }
}
