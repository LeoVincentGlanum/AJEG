<?php

namespace App\Http\Livewire\User;

use App\Http\Livewire\Traits\HasToast;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Illuminate\Database\Eloquent\Builder;

class Notifications extends Component
{
    use HasToast;

    public array|Collection $notifications;

    public array $creatorNotifications;

    public function mount()
    {
        try {
            $this->notifications = Notification::query()
                ->with(['usersNotifications', 'userNotifications'])
                ->whereHas('userNotifications', function (Builder $query) {
                    $query->where('user_id', Auth::id());
                })
                ->get();

            foreach ($this->notifications as $notification) {
                $this->creatorNotifications[$notification->id] = User::query()->where('id', $notification->creator)->first();
            }
        } catch (\Throwable $e) {
            Log::error($e->getMessage());
            $this->notifications = [];
            $this->errorToast(__('An error occurred while retrieving your games'));
        }
    }

    public function render()
    {
        return view('livewire.user.notifications');
    }
}
