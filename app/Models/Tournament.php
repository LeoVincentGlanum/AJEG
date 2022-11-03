<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tournament extends Model
{
    use HasFactory;

    protected $table = 'tournaments';

    protected $fillable = [
        'organizer_id',
        'name',
        'number_of_players',
        'entrance_fee',
        'game_type_id',
        'notification',
        'status_id',
        'start_date',
        'end_date',
        'winner_id',
    ];

    public function organizer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'organizer_id', 'id');
    }

    public function gameType(): BelongsTo
    {
        return $this->belongsTo(GameType::class, 'game_type_id', 'id');
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(TournamentStatus::class, 'status_id', 'id');
    }

    public function winner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'winner_id', 'id');
    }
}
