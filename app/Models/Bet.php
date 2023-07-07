<?php

namespace App\Models;

use App\ModelStates\BetState;
use Illuminate\Database\Eloquent\Model;
use Spatie\ModelStates\HasStates;

class Bet extends Model
{
    use HasStates;

    protected $table = "bets";

    protected $fillable = [
        'game_id',
        'gambler_id',
        'gameplayer_id',
        'bet_deposit',
        'bet_gain',
        'bet_status',
    ];

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

    public function game()
    {
        return $this->belongsTo(Game::class, 'game_id', 'id');
    }
}
