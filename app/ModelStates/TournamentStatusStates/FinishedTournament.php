<?php

namespace App\ModelStates\TournamentStatusStates;

class FinishedTournament extends \App\ModelStates\TournamentStatus
{
    public static string $name = 'finished';

    public function color(): string
    {
        // TODO: Implement color() method.
    }
    public function name(): string
    {
        return trans('finished');
    }
}
