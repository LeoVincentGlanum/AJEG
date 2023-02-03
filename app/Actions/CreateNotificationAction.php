<?php

namespace App\Actions;

use App\Models\Notification;
use App\Models\Quote;
use Illuminate\Support\Facades\Auth;

class CreateNotificationAction
{
    public function execute(int $creator, string $type, string $message): Notification
    {
        $notification = new Notification();
        $notification->creator = $creator;
        $notification->type = $type;
        $notification->message = $message;
        $notification->save();

        return $notification;
    }
}
