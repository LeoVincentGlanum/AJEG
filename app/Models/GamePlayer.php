<?php

namespace App\Models;

use App\Enums\GameResultEnum;
use App\ModelStates\PlayerParticipationState;
use App\ModelStates\PlayerResultState;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\ModelStates\HasStates;

class GamePlayer extends Model
{
    use HasFactory;
    use HasStates;
    protected $table = 'game_players';

    protected $fillable = [
        'game_id',
        'user_id',
        'result',
    ];

    protected $casts = [
        'player_result_validation' =>  playerResultState::class,
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
