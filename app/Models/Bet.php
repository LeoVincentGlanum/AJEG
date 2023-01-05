<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\ModelStates\HasStates;

class Bet extends Model
{
    use HasStates;

    public function users()
    {
        return $this->hasMany(User::class, 'id', 'gambler_id');
    }

    public function gamePlayer()
    {
        return $this->hasMany(GamePlayer::class, 'id', 'player_bet_on');
    }

    public function games()
    {
        return $this->hasMany(Game::class, 'id', 'game_id');
    }
}
