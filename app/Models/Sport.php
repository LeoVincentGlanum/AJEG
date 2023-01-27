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

class Sport extends Authenticatable
{

    use HasApiTokens, HasFactory, Notifiable;

    protected $table = "ajeg_sports";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'label',

    ];

    public function elos(): HasMany
    {
        return $this->hasMany(Elo::class, 'sport_id', 'id');
    }
}
