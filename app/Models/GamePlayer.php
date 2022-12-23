<?php

namespace App\Models;

use App\Enums\GameResultEnum;
use App\ModelStates\GameStates\PlayersValidation;
use App\ModelStates\PlayerParticipationState;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GamePlayer extends Model
{
    use HasFactory;

    protected $table = 'game_players';

    protected $fillable = [
        'game_id',
        'user_id',
        'result',
    ];

    protected $casts = [
        'result' => GameResultEnum::class,
        'player_validation' =>  PlayersValidation::class,
        'player_participation_validation' => PlayerParticipationState::class

    ];

    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class, 'game_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
