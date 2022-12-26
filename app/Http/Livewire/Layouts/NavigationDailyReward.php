<?php

namespace App\Http\Livewire\Layouts;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class NavigationDailyReward extends Component
{
    public bool $isDailyRewardAvailable;

    public function mount()
    {
        $this->isDailyRewardAvailable = Auth::user()->isDailyRewardAvailable();
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

            $this->dispatchBrowserEvent('toast', [
                'message' => 'Votre récompense quotidienne a bien été récupéré',
                'type' => 'success',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            Log::info($e->getMessage());

            $this->dispatchBrowserEvent('toast', [
                'message' => 'Une erreur est survenu, réessaye plus tard',
                'type' => 'error',
            ]);
        }
    }

    public function render()
    {
        return view('livewire.layouts.navigation-daily-reward');
    }
}
