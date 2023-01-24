<?php

namespace App\ModelStates;

use App\ModelStates\GamePlayerResultStates\Loss;
use App\ModelStates\GamePlayerResultStates\Draw;
use App\ModelStates\GamePlayerResultStates\Pat;
use App\ModelStates\GamePlayerResultStates\PendingResult;
use App\ModelStates\GamePlayerResultStates\Win;
use Spatie\ModelStates\State;
use Spatie\ModelStates\StateConfig;

abstract class GamePlayerResultState extends State
{
    abstract public function color(): string;

    abstract public function name(): string;

    public static function config(): StateConfig
    {
        return parent::config()
            ->default(PendingResult::class)
            ->allowTransition(PendingResult::class, Win::class)
            ->allowTransition(PendingResult::class, Loss::class)
            ->allowTransition(PendingResult::class, Pat::class)
            ->allowTransition(PendingResult::class, Draw::class)

            ->registerState(PendingResult::class)
            ->registerState(Win::class)
            ->registerState(Loss::class)
            ->registerState(Pat::class)
            ->registerState(Draw::class);
    }

    public static function gameFinishedResults(): array
    {
        return [
            Win::class => Win::$name,
            Loss::class => Loss::$name,
            Pat::class => Pat::$name,
            Draw::class => Draw::$name,
        ];
    }
}

