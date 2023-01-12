<?php

namespace App\ModelStates\TournamentTypeStates;

class Championship extends \App\ModelStates\TournamentType
{
    public static string $name = 'Championship';

    public function color(): string
    {
        // TODO: Implement color() method.
    }
    public function name(): string
    {
        return trans('Championship');
    }
}
