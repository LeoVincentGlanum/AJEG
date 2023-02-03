<?php

 namespace App\ModelStates;


use App\ModelStates\TournamentTypeStates\AllPlayAll;
use App\ModelStates\TournamentTypeStates\Championship;
use Spatie\ModelStates\State;
use Spatie\ModelStates\StateConfig;

abstract class TournamentType extends State
{
    abstract public function color(): string;

    abstract public function name(): string;
    public static function config(): StateConfig
    {
        return parent::config()
            ->default(Championship::class)

            ->allowTransition(Championship::class, AllPlayAll::class)
            ->allowTransition(AllPlayAll::class, Championship::class)

            ->registerState(Championship::class)
            ->registerState(AllPlayAll::class);
    }


}

