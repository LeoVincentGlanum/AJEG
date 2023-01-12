<?php

namespace App\ModelStates\TournamentStatusStates;

class FullTournament extends \App\ModelStates\TournamentStatus
{
    public static string $name = 'Full';

    public function color(): string
    {
        // TODO: Implement color() method.
    }
    public function name(): string
    {
        return trans('Full');
    }
}
