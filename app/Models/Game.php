<?php

namespace App\Models;

use App\Enums\GameStatusEnum;
use App\Enums\SportEnum;
use App\ModelStates\GameStates\Draft;
use App\ModelStates\GameStates\GameAccepted;
use App\ModelStates\GameStates\InProgress;
use App\ModelStates\GameStates\PlayersValidation;
use App\ModelStates\GameStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Auth;
use Spatie\ModelStates\HasStates;

class Game extends Model
{
    use HasFactory;
    use HasStates;

    protected $table = 'games';

    protected $fillable = [
        'label',
        'status',
        'bet_available',
        'created_by',
        'sport_id'
    ];

    protected $casts = [
        'status' => GameStatus::class
    ];


    public function gamePlayers(): HasMany
    {
        return $this->hasMany(GamePlayer::class, 'game_id', 'id');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class,'game_players', 'game_id', 'user_id', 'id', 'id')->withPivot('result','color','player_participation_validation','player_result_validation');
    }

    public function creator(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function bets(): HasMany
    {
        return $this->hasMany(Bet::class, 'game_id', 'id');
    }

    public function isStatusNeedResult(): bool
    {
        if ($this->status->equals(Draft::class)) {
            return false;
        }

        if ($this->status->equals(PlayersValidation::class)) {
            return false;
        }

        if ($this->status->equals(GameAccepted::class)) {
            return false;
        }

        if ($this->status->equals(InProgress::class)) {
            return false;
        }

        return true;
    }

    public function isPlayerParticipationValidationNeeded(): bool
    {
        if ($this->status->equals(Draft::class)) {
            return false;
        }

        if ($this->status->equals(PlayersValidation::class)) {
            return false;
        }

        return true;
    }

    public function isPlayerResultValidationNeeded(): bool
    {
        if ($this->status->equals(Draft::class)) {
            return false;
        }

        if ($this->status->equals(PlayersValidation::class)) {
            return false;
        }

        if ($this->status->equals(GameAccepted::class)) {
            return false;
        }

        if ($this->status->equals(InProgress::class)) {
            return false;
        }

        return true;
    }
}
