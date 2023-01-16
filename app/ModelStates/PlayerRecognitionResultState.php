<?php

 namespace App\ModelStates;

use App\ModelStates\PlayerRecognitionResultStates\Accepted;
use App\ModelStates\PlayerRecognitionResultStates\Pending;
use App\ModelStates\PlayerRecognitionResultStates\Refused;
use Spatie\ModelStates\State;
use Spatie\ModelStates\StateConfig;

abstract class PlayerRecognitionResultState extends State
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

