<?php

 namespace App\ModelStates;

use App\ModelStates\BetStates\LooseBet;
use App\ModelStates\BetStates\PendingBet;
use App\ModelStates\BetStates\WinBet;
use App\ModelStates\PlayerResultStates\Accepted;
use App\ModelStates\PlayerResultStates\Pending;
use App\ModelStates\PlayerResultStates\Refused;
use App\ModelStates\TournamentStatusStates\CanceledTournament;
use App\ModelStates\TournamentStatusStates\FinishedTournament;
use App\ModelStates\TournamentStatusStates\FullTournament;
use App\ModelStates\TournamentStatusStates\OpenTournament;
use App\ModelStates\TournamentStatusStates\StartedTournament;
use Spatie\ModelStates\State;
use Spatie\ModelStates\StateConfig;

abstract class TournamentStatus extends State
{
    abstract public function color(): string;

    abstract public function name(): string;
    public static function config(): StateConfig
    {
        return parent::config()
            ->default(OpenTournament::class)

            ->allowTransition(OpenTournament::class, StartedTournament::class)
            ->allowTransition(OpenTournament::class, CanceledTournament::class)
            ->allowTransition(OpenTournament::class, FullTournament::class)
            ->allowTransition(OpenTournament::class, FinishedTournament::class)

            ->allowTransition(FullTournament::class, StartedTournament::class)

            ->allowTransition(StartedTournament::class, FinishedTournament::class)
            ->allowTransition(StartedTournament::class, CanceledTournament::class)

            ->registerState(OpenTournament::class)
            ->registerState(StartedTournament::class)
            ->registerState(CanceledTournament::class)
            ->registerState(FullTournament::class)
            ->registerState(FinishedTournament::class);
    }


}

