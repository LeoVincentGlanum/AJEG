<?php

namespace App\Http\Livewire\User;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Arr;

class Profile extends Component
{
    public User $user;

    public array $tabs = [
        'dashboard',
        'detail',
        'notifications'
    ];

    public string $tab = 'dashboard';

    public bool $isTabAvailable = false;

    public int $numberOfNotifications;

    protected $listeners = ['changeTab'];

    public function mount(User $user)
    {
        $this->user = $user;
        $this->isTabAvailable = Auth::user()->id === $user->id;
        $this->numberOfNotifications = Auth::user()->notifications->count();
    }

    public function changeTab(string $tab)
    {
        $this->tab = $tab;
    }

    public function render()
    {
        return view('livewire.user.profile');
    }
}
