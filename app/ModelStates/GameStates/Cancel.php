<?php

namespace App\ModelStates\GameStates;

class Cancel extends \App\ModelStates\GameStatus
{

    public static string $name = 'cancel';
    public function color(): string
    {
        return "red";
    }

    public function name(): string
    {
        return trans('cancel');
    }
}
