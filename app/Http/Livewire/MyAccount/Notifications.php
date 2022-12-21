<?php

namespace App\Http\Livewire\MyAccount;

use App\Models\Notification;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Database\Eloquent\Builder;


class Notifications extends Component
{
    public Collection $notifications;
    public Collection $creatorNotification;

    public function mount(){
        $this->notifications = Notification::query()
            ->with(['usersNotifications','userNotifications'])
            ->whereHas('userNotifications', function (Builder $query) {
                $query->where('user_id',Auth::id());
            })
            ->get();
    }

    public function render()
    {
        return view('livewire.my-account.notifications');
    }
}
