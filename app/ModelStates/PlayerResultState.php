<?php

 namespace App\ModelStates;

use App\ModelStates\PlayerResultStates\Accepted;
use App\ModelStates\PlayerResultStates\Pending;
use App\ModelStates\PlayerResultStates\Refused;
use Spatie\ModelStates\State;
use Spatie\ModelStates\StateConfig;

abstract class PlayerResultState extends State
{
    abstract public function color(): string;

    abstract public function name(): string;
    public static function config(): StateConfig
    {
        return parent::config()
            ->default(Pending::class)
            ->allowTransition(Pending::class, Accepted::class)
            ->allowTransition(Pending::class, Refused::class)

            ->registerState(Pending::class)
            ->registerState(Accepted::class)
            ->registerState(Refused::class);
    }


}

