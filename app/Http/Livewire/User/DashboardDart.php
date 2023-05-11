<?php

namespace App\Http\Livewire\User;

use App\Models\DartScore;
use App\Models\User;
use Livewire\Component;

class DashboardDart extends Component
{
    public User $user;
    public array $scoreHistoryValues = [];
    public array $scoreHistoryLabels = [];


    public function mount(User $user){
        $this->user = $user;
        $this->scoreHistoryValues = DartScore::query()->where('user_id', $this->user->id)->get()->pluck('score')->toArray();
        $this->scoreHistoryLabels = DartScore::query()->where('user_id', $this->user->id)->get()->pluck('created_at')->toArray();

    }

    public function render()
    {
        return view('livewire.user.dashboard-dart');
    }
}
