<?php

namespace App\Actions;

use App\Models\Notification;
use App\Models\UserNotification;
use Illuminate\Support\Facades\Auth;

class SendNotificationAction
{
    public function execute(int $notification_id, int $user_id)
    {
        $UserNotification = new UserNotification();
        $UserNotification->notification_id = $notification_id;
        $UserNotification->user_id = $user_id;
        $UserNotification->is_done = '0';
        $UserNotification->save();
    }
}
