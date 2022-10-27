<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Game extends Model
{
    use HasFactory;

    protected $with = [
        'gamePlayer'
    ];

    protected $attributes = [
        'id'
    ];

    protected $fillable = [
        'user_white',
        'user_black',
        'status',
    ];


    public function user_white() {
        return $this->hasMany(User::class, 'id', 'user_white');
    }

    public function user_black() {
        return $this->hasMany(User::class, 'id', 'user_black');
    }

    public function gamePlayer() {
        return $this->hasMany(GamePlayer::class, 'game_id', 'id');
    }
    
}
