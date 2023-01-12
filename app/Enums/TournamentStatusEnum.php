<?php

namespace App\Enums;

use App\ModelStates\TournamentStatusStates\CanceledTournament;
use App\ModelStates\TournamentStatusStates\FinishedTournament;
use App\ModelStates\TournamentStatusStates\FullTournament;
use App\ModelStates\TournamentStatusStates\OpenTournament;
use App\ModelStates\TournamentStatusStates\StartedTournament;

enum TournamentStatusEnum:string
{
    case open = 'Open';
    case full = 'Full';
    case started = 'Started';
    case finished = 'Finished';
    case canceled = 'Canceled';

    public function position(): int
    {
        return self::getPosition($this);
    }

    public static function getPosition(self $value): int
    {
        return match ($value) {
            self::open => 1,
            self::full => 2,
            self::started => 3,
            self::finished => 4,
            self::canceled => 5,
        };
    }

    public static function mapWithStateMachine(string $value): array
    {
        return match($value) {
            self::open->value => [OpenTournament::class],
            self::full->value => [FullTournament::class],
            self::started->value => [StartedTournament::class],
            self::finished->value => [FinishedTournament::class],
            self::canceled->value => [CanceledTournament::class],
        };
    }
}
