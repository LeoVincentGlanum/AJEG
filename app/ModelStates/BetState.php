<?php

 namespace App\ModelStates;

use App\ModelStates\BetStates\LooseBet;
use App\ModelStates\BetStates\PendingBet;
use App\ModelStates\BetStates\WinBet;
use App\ModelStates\PlayerResultStates\Accepted;
use App\ModelStates\PlayerResultStates\Pending;
use App\ModelStates\PlayerResultStates\Refused;
use Spatie\ModelStates\State;
use Spatie\ModelStates\StateConfig;

abstract class BetState extends State
{
    abstract public function color(): string;

    abstract public function name(): string;
    public static function config(): StateConfig
    {
        return parent::config()
            ->default(PendingBet::class)


            ->allowTransition(PendingBet::class, WinBet::class)
            ->allowTransition(PendingBet::class, LooseBet::class)

            ->registerState(PendingBet::class)
            ->registerState(WinBet::class)
            ->registerState(LooseBet::class);
    }


}

