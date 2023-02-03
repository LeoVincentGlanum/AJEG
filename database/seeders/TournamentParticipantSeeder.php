<?php

namespace Database\Seeders;

use App\Models\Tournament;
use App\Models\User;
use App\ModelStates\TournamentStatusStates\FinishedTournament;
use App\ModelStates\TournamentStatusStates\FullTournament;
use App\ModelStates\TournamentTypeStates\AllPlayAll;
use App\ModelStates\TournamentTypeStates\Championship;
use Illuminate\Database\Seeder;

class TournamentParticipantSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $tournaments = Tournament::all();
        $players = User::all();

        foreach ($tournaments as $tournament) {
            $nbOfPlayers = random_int(3, 12);
            $participants = [];
            $nbMatchs = 2;

            if ($tournament->status->equals(FullTournament::class)) {
                $nbOfPlayers = $tournament->number_of_players;
            }

            if ($tournament->type->equals(AllPlayAll::class)) {
                $nbMatchs = $nbOfPlayers - 1;
            }

            if ($tournament->type->equals(Championship::class)) {
                $nbMatchs = ceil(sqrt($nbOfPlayers));
            }

            $tournamentParticipants = [];
            $winnerId = null;
            $winnerPoints = 0;
            $results = [];
            for ($i = 0; $i < random_int(3, $nbOfPlayers); $i++) {
                $player = $players->whereNotIn('id', $participants)->random(1)->first();
                $participants[] = $player->id;
                $nbWins = 0;
                $nbPats = 0;
                $nbDraws = 0;
                $nbLosses = 0;

                if (
                    $tournament->status->equals(FinishedTournament::class)
                    || $tournament->status->equals(FinishedTournament::class)
                ) {
                    $nbWins = random_int(0, $nbMatchs);
                    $nbPats = random_int(0, $nbMatchs - $nbWins);
                    $nbDraws = random_int(0, $nbMatchs - $nbWins - $nbPats);
                    $nbLosses = $nbMatchs - $nbWins - $nbPats - $nbDraws;

                    $results[$i]['wins'] = random_int(0, $nbMatchs);
                    $results[$i]['pats'] = random_int(0, $nbMatchs - $nbWins);
                    $results[$i]['draws'] = random_int(0, $nbMatchs - $nbWins - $nbPats);
                    $results[$i]['losses'] = $nbMatchs - $nbWins - $nbPats - $nbDraws;

                    $points = (3 * $nbWins) + $nbPats - (3 * $nbLosses);

                    if ($points > $winnerPoints) {
                        $winnerId = $player->id;
                        $winnerPoints = $points;
                    }
                }

                $tournamentParticipants[] = [
                    'user_id' => $player->id,
                    'wins' => $nbWins,
                    'pats' => $nbPats,
                    'draws' => $nbDraws,
                    'losses' => $nbLosses,
                ];
            }

            $tournament->scores()->createMany($tournamentParticipants);

            if ($tournament->status->equals(FinishedTournament::class)) {
                $tournament->update(['winner_id' => $winnerId]);
            }
        }
    }
}
