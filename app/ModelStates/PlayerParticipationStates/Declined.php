<?php

namespace App\ModelStates\PlayerParticipationStates;

class Declined extends \App\ModelStates\PlayerParticipationState
{

    public static string $name = 'declined';


    public function color(): string
    {
        // TODO: Implement color() method.
    }

    public function name() : string
    {
        return trans('declined');
    }
}
