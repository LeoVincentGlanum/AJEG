<?php

namespace App\ModelStates\TournamentTypeStates;

class AllPlayAll extends \App\ModelStates\TournamentType
{
    public static string $name = 'All-Play-All';

    public function color(): string
    {
        // TODO: Implement color() method.
    }
    public function name(): string
    {
        return trans('All-Play-All');
    }
}
