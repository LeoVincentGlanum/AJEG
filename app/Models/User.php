<?php

namespace App\Models;

use App\Enums\GameResultEnum;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{

    use HasApiTokens, HasFactory, Notifiable;

    protected $table = "ajeg_users";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'coins',
        'daily_reward',
        'photo',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'user_id', 'id');
    }

    public function game(): HasMany
    {
        return $this->hasMany(Game::class, 'created_by', 'id');
    }

    public function elos(): HasMany
    {
        return $this->hasMany(Elo::class, 'user_id', 'id');
    }

    public function organize(): HasMany
    {
        return $this->hasMany(Tournament::class, 'organizer_id', 'id');
    }

    public function participating(): BelongsToMany
    {
        return $this->belongsToMany(Tournament::class, 'ajeg_tournament_participants')
            ->using(TournamentParticipant::class)
            ->withPivot(['wins', 'paths', 'draws', 'losses']);
    }

    public function getParticipationScore(): float|int
    {
        $winsScore = $this->pivot->wins * GameResultEnum::Win->tournamentPoint();
        $patsScore = $this->pivot->pats * GameResultEnum::Pat->tournamentPoint();
        $lossesScore = $this->pivot->losses * GameResultEnum::Loss->tournamentPoint();

        return $winsScore + $patsScore - $lossesScore;
    }

    public function isDailyRewardAvailable(): bool
    {
        if (Auth::id() !== $this->id) {
            return false;
        }

        $userDailyReward = $this->daily_reward;
        $now = Carbon::now()->timezone('Europe/Paris')->format('Y-m-d H:i:m');

        return Carbon::parse($userDailyReward)->lessThanOrEqualTo($now);
    }

    public function isParticipantScorePositif(): bool
    {
        return $this->getParticipationScore() > 0;
    }

    public function isParticipantScoreNegative(): bool
    {
        return $this->getParticipationScore() < 0;
    }
}
