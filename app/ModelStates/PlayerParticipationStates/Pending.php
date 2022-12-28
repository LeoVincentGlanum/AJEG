<?php

namespace App\ModelStates\PlayerParticipationStates;

class Pending extends \App\ModelStates\PlayerParticipationState
{
    public static string $name = 'pending';
    public function color(): string
    {
        // TODO: Implement color() method.
    }

    public function name() : string
    {
        return trans('pending');
    }
}
