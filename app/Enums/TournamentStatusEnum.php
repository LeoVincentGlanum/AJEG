<?php

namespace App\Enums;

enum TournamentStatusEnum:string
{
    case open = 'Open';
    case full = 'Full';
    case started = 'Started';
    case finished = 'Finished';
    case canceled = 'Canceled';

    public function position(): int
    {
        return TournamentStatusEnum::getPosition($this);
    }

    public static function getPosition(self $value): int
    {
        return match ($value) {
            TournamentStatusEnum::open => 1,
            TournamentStatusEnum::full => 2,
            TournamentStatusEnum::started => 3,
            TournamentStatusEnum::finished => 4,
            TournamentStatusEnum::canceled => 5,
        };
    }
}
