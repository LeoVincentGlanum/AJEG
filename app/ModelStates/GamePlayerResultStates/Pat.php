<?php

namespace App\ModelStates\GamePlayerResultStates;

class Pat extends \App\ModelStates\GamePlayerResultState
{

    public static string $name = 'pat';
    public function color(): string
    {
        return "grey";
    }

    public function name() : string
    {
        return trans('pat');
    }
}
