<?php

namespace App\ModelStates\TournamentStatusStates;

class CanceledTournament extends \App\ModelStates\TournamentStatus
{
    public static string $name = 'canceled';

    public function color(): string
    {
        // TODO: Implement color() method.
    }
    public function name(): string
    {
        return trans('canceled');
    }
}
