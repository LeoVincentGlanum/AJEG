<?php

namespace App\ModelStates;

use App\ModelStates\GameStates\Archived;
use App\ModelStates\GameStates\AskAdmin;
use App\ModelStates\GameStates\Cancel;
use App\ModelStates\GameStates\Draft;
use App\ModelStates\GameStates\GameAccepted;
use App\ModelStates\GameStates\InProgress;
use App\ModelStates\GameStates\PlayersValidation;
use App\ModelStates\GameStates\ResultValidations;
use App\ModelStates\GameStates\Validate;
use Spatie\ModelStates\State;
use Spatie\ModelStates\StateConfig;

abstract class GameStatus extends State
{
    public static function config(): StateConfig
    {
        return parent::config()
            ->default(Draft::class)
            ->allowTransition(Draft::class, PlayersValidation::class)
            ->allowTransition(Draft::class, Cancel::class)
            ->allowTransition(Draft::class, Archived::class)
            ->allowTransition(Draft::class, ResultValidations::class)
            ->allowTransition(Draft::class, GameAccepted::class)
            ->allowTransition(PlayersValidation::class, Draft::class)
            ->allowTransition(PlayersValidation::class, GameAccepted::class)
            ->allowTransition(GameAccepted::class, InProgress::class)
            ->allowTransition(InProgress::class, Cancel::class)
            ->allowTransition(InProgress::class, ResultValidations::class)
            ->allowTransition(ResultValidations::class, AskAdmin::class)
            ->allowTransition(ResultValidations::class, Validate::class)
            ->allowTransition(AskAdmin::class, Cancel::class)
            ->allowTransition(AskAdmin::class, Validate::class)
            ->registerState(Draft::class)
            ->registerState(PlayersValidation::class)
            ->registerState(GameAccepted::class)
            ->registerState(InProgress::class)
            ->registerState(ResultValidations::class)
            ->registerState(AskAdmin::class)
            ->registerState(Validate::class)
            ->registerState(Cancel::class);
    }

    abstract public function color(): string;

    abstract public function name(): string;
}

