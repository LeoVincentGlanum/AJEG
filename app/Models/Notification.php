<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Notification extends Model
{
    use HasFactory;

    /**
     * @var int|mixed
     */
    protected $table = 'notifications';

    protected $fillable = [
        '*',
    ];

    public function userNotifications() : HasMany
    {
        return $this->hasMany(UserNotification::class, 'notification_id', 'id');
    }

    public function usersNotifications() : BelongsToMany
    {
        return $this->belongsToMany(Notification::class,'user_notifications', 'notification_id', 'user_id', 'id', 'id')->withPivot('is_done');
    }
}
