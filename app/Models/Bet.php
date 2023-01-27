<?php

namespace App\Models;

use App\ModelStates\BetState;
use Illuminate\Database\Eloquent\Model;
use Spatie\ModelStates\HasStates;

class Bet extends Model
{
    use HasStates;

    protected $table = "ajeg_bets";

    protected $casts = [
        'bet_status' => BetState::class
    ];

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
