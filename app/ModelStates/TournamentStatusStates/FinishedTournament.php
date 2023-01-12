<?php

namespace App\ModelStates\TournamentStatusStates;

class FinishedTournament extends \App\ModelStates\TournamentStatus
{
    public static string $name = 'Finished';

    public function color(): string
    {
        // TODO: Implement color() method.
    }
    public function name(): string
    {
        return trans('Finished');
    }
}
