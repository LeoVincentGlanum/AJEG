<?php

namespace App\Models;

use App\Enums\TournamentStatusEnum;
use App\Enums\TournamentTypeEnum;
use App\ModelStates\TournamentStatus;
use App\ModelStates\TournamentType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tournament extends Model
{
    use HasFactory;

    protected $table = 'ajeg_tournaments';

    protected $fillable = [
        'organizer_id',
        'name',
        'number_of_players',
        'entrance_fee',
        'game_type_id',
        'notification',
        'type',
        'elo_min',
        'elo_max',
        'status',
        'start_date',
        'end_date',
        'winner_id',
    ];

//    protected $casts = [
//        'type' => TournamentTypeEnum::class,
//        'status' => TournamentStatusEnum::class
//    ];

    protected $casts = [
        'type' => TournamentType::class,
        'status' => TournamentStatus::class
    ];

    public function organizer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'organizer_id', 'id');
    }

    public function gameType(): BelongsTo
    {
        return $this->belongsTo(GameType::class, 'game_type_id', 'id');
    }

    public function participants(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'ajeg_tournament_participants')
            ->using(TournamentParticipant::class)
            ->withPivot(['wins', 'pats', 'draws', 'losses']);
    }

    public function scores(): HasMany
    {
        return $this->hasMany(TournamentParticipant::class, 'tournament_id', 'id');
    }

    public function winner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'winner_id', 'id');
    }

    public function getEloRequired(): string
    {
        if ($this->elo_min === null && $this->elo_max === null) {
            return 'Everyone';
        }

        if ($this->elo_max === null) {
            return '+' . $this->elo_min;
        }

        if ($this->elo_min === null) {
            return '-' . $this->elo_max;
        }

        return $this->elo_min . ' - ' . $this->elo_max;
    }

    public function isOpen(): bool
    {
        return $this->status === TournamentStatusEnum::open;
    }

    public function isStarted(): bool
    {
        return $this->status === TournamentStatusEnum::started;
    }

    public function isCanceled(): bool
    {
        return $this->status === TournamentStatusEnum::canceled;
    }

    public function isEditable(): bool
    {
        var_dump($this->status);
        if ($this->status->position() > TournamentStatusEnum::started->position()) {
            return false;
        }

        if ($this->participants->count() > 0) {
            return false;
        }

        return true;
    }

    public function isCancelable(): bool
    {
        return $this->status->position() < TournamentStatusEnum::finished->position();
    }
}
