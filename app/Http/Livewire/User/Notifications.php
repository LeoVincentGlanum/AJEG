<?php

namespace App\Http\Livewire\User;

use App\Http\Livewire\Traits\HasToast;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Illuminate\Database\Eloquent\Builder;

class Notifications extends Component
{
    use HasToast;

    public array|Collection $notifications;

    public Notification $notification;

    public function mount()
    {
        $this->notifications = Auth::user()->notifications;
//        dd($this->notifications);
        foreach ($this->notifications as $notification) {
//            $this->updateReadAt($notification->id);
//            $this->creatorNotifications[$notification->id] = User::query()->where('id', $notification->creator)->first();
        }
    }

    public function updateReadAt($id)
    {
//        dd('ici');
        $notification = Notification::query()->where('id', $id)->firstOrFail();
        $notification->read_at = Carbon::now();
        $notification->save();
    }


    public function render()
    {
        return view('livewire.user.notifications');
    }
}
