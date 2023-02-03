<?php

namespace App\ModelStates\GamePlayerResultStates;

class Win extends \App\ModelStates\GamePlayerResultState
{

    public static string $name = 'win';
    public function color(): string
    {
        return "green";
    }

    public function name() : string
    {
        return trans('win');
    }
}
