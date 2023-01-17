<?php

namespace App\ModelStates\GamePlayerResultStates;

class PendingResult extends \App\ModelStates\GamePlayerResultState
{

    public static string $name = 'pending';
    public function color(): string
    {
        return "white";
    }

    public function name() : string
    {
        return trans('pending');
    }
}
