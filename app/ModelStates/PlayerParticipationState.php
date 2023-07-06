<?php

 namespace App\ModelStates;

use App\ModelStates\GameStates\GameAccepted;
use App\ModelStates\PlayerParticipationStates\Draft;
use App\ModelStates\PlayerParticipationStates\Accepted;
use App\ModelStates\PlayerParticipationStates\Declined;
use App\ModelStates\PlayerParticipationStates\Pending;
use Spatie\ModelStates\State;
use Spatie\ModelStates\StateConfig;

abstract class PlayerParticipationState extends State
{
    abstract public function color(): string;

    abstract public function name(): string;

    public static function config(): StateConfig
    {
        return parent::config()
            ->default(Pending::class)

            ->allowTransition(Pending::class, Accepted::class)
            ->allowTransition(Pending::class, Declined::class)

            ->registerState(Pending::class)
            ->registerState(Accepted::class)
            ->registerState(Declined::class);
    }


}

