<?php

namespace Database\Seeders;

use App\Models\GameType;
use App\Models\User;
use App\ModelStates\TournamentStatusStates\CanceledTournament;
use App\ModelStates\TournamentStatusStates\FinishedTournament;
use App\ModelStates\TournamentStatusStates\FullTournament;
use App\ModelStates\TournamentStatusStates\OpenTournament;
use App\ModelStates\TournamentStatusStates\StartedTournament;
use App\ModelStates\TournamentTypeStates\AllPlayAll;
use App\ModelStates\TournamentTypeStates\Championship;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class TournamentSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $organizers = User::all();
        $gameTypes = GameType::all();
        $capacity = [4, 6, 8, 10, 12];
        $type = [
            AllPlayAll::class,
            Championship::class,
        ];
        $allStatus = [
            CanceledTournament::class,
            OpenTournament::class,
            FullTournament::class,
            StartedTournament::class,
            FinishedTournament::class
        ];

        foreach ($organizers as $organizer) {
            $tournaments = [];

            for ($i = 0; $i < random_int(0, 5); $i++) {
                $numberMin = random_int(0, 1000);
                $numberMax = random_int($numberMin + 100, 2000);
                $eloMin = Arr::random([null, $numberMin]);
                $eloMax = Arr::random([null, $numberMax]);
                $gameType = $gameTypes->first();
                $startDate = null;
                $endDate = null;

                $status = Arr::random($allStatus);
                if ($status === StartedTournament::class) {
                    $startDate = now();
                }

                if ($status === FinishedTournament::class) {
                    $startDate = now()->subDays(random_int(0,30));
                    $endDate = $startDate->addDays(random_int(1, 7));
                }

                $tournaments[] = [
                    'name' => $organizer->name.'\'s Tournament '.$i + 1,
                    'number_of_players' => Arr::random($capacity),
                    'entrance_fee' => random_int(0, 5000),
                    'game_type_id' => $gameType->id,
                    'type' => Arr::random($type),
                    'elo_min' => $eloMin,
                    'elo_max' => $eloMax,
                    'status' => $status,
                    'start_date' => $startDate,
                    'end_date' => $endDate,
                ];
            }

            $organizer->organize()->createMany($tournaments);
        }
    }
}
