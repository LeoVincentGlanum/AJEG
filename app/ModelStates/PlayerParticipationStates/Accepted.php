<?php

namespace App\ModelStates\PlayerParticipationStates;

class Accepted extends \App\ModelStates\PlayerParticipationState
{

    public static string $name = 'accepted';
    public function color(): string
    {
        return "green";
    }

    public function name() : string
    {
        return trans('accepted');
    }
}
