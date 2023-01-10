<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\ModelStates\HasStates;

class Bet extends Model
{
    use HasStates;

    public function user()
    {
        return $this->belongsTo(User::class, 'gambler_id', 'id');
    }

    public function gamePlayers()
    {
        return $this->hasMany(GamePlayer::class, 'id', 'gameplayer_id');
    }

    public function games()
    {
        return $this->hasMany(Game::class, 'id', 'game_id');
    }
}
