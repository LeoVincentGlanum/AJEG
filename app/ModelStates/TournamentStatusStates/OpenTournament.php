<?php

namespace App\ModelStates\TournamentStatusStates;

class OpenTournament extends \App\ModelStates\TournamentStatus
{
    public static string $name = 'Open';

    public function color(): string
    {
        // TODO: Implement color() method.
    }
    public function name(): string
    {
        return trans('Open');
    }
}
