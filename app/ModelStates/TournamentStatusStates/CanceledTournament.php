<?php

namespace App\ModelStates\TournamentStatusStates;

class CanceledTournament extends \App\ModelStates\TournamentStatus
{
    public static string $name = 'Canceled';

    public function color(): string
    {
        // TODO: Implement color() method.
    }
    public function name(): string
    {
        return trans('Canceled');
    }
}
