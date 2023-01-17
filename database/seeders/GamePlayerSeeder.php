<?php

namespace Database\Seeders;

use App\Enums\GameResultEnum;
use App\Models\Game;
use App\Models\User;
use App\ModelStates\GamePlayerResultStates\Draw;
use App\ModelStates\GamePlayerResultStates\Loss;
use App\ModelStates\GamePlayerResultStates\Pat;
use App\ModelStates\GamePlayerResultStates\Win;
use App\ModelStates\GameStates\AskAdmin;
use App\ModelStates\GameStates\Validate;
use App\ModelStates\PlayerParticipationStates\Accepted as PlayerParticipationAccepted;
use App\ModelStates\PlayerRecognitionResultStates\Accepted as PlayerResultAccepted;
use App\ModelStates\PlayerRecognitionResultStates\Refused as PlayerResultRefused;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class GamePlayerSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $games = Game::all();
        $players = User::all();
        $results = GameResultEnum::cases();
        $colors = ['black', 'white'];
        $resultsValidation = [PlayerResultAccepted::class, PlayerResultRefused::class];

        foreach ($games as $game) {
            $player = $players->whereNotIn('id', $game->created_by)->random(1)->first();
            $colors1 = Arr::random($colors);
            $colors2 = match ($colors1) {
                'black' => 'white',
                'white' => 'black',
            };

            $result1 = null;
            $result2 = null;
            if ($game->isStatusNeedResult()) {
                $result1 = Arr::random($results)->value;
                $result2 = match ($result1) {
                    Win::$name => Loss::$name,
                    Loss::$name => Win::$name,
                    Pat::$name => Pat::$name,
                    Draw::$name => Draw::$name,
                };
            }

            $participationValidation = null;
            if ($game->isPlayerResultValidationNeeded()) {
                $participationValidation = PlayerParticipationAccepted::class;
            }

            $resultValidation1 = null;
            $resultValidation2 = null;
            if ($game->status->equals(Validate::class)) {
                $resultValidation1 = PlayerResultAccepted::class;
                $resultValidation2 = PlayerResultAccepted::class;
            }

            if ($game->status->equals(AskAdmin::class)) {
                $resultValidation1 = Arr::random($resultsValidation);
                $resultValidation2 = match ($resultValidation1) {
                    PlayerResultAccepted::class => PlayerResultRefused::class,
                    PlayerResultRefused::class => PlayerResultAccepted::class,
                };
            }

            $ratio1 = null;
            $ratio2 = null;
            if ($game->bet_available) {
                $ratio1 = ($game->creator->elo / $player->elo) + 1;
                $ratio2 = ($player->elo / $game->creator->elo) + 1;
            }

            $game->gamePlayers()->createMany([
                [
                    'user_id' => $game->created_by,
                    'color' => $colors1,
                    'result' => $result1,
                    'player_participation_validation' => $participationValidation,
                    'player_result_validation' => $resultValidation1,
                    'bet_ratio' => $ratio1
                ],
                [
                    'user_id' => $player->id,
                    'color' => $colors2,
                    'result' => $result2,
                    'player_participation_validation' => $participationValidation,
                    'player_result_validation' => $resultValidation2,
                    'bet_ratio' => $ratio2
                ]
            ]);
        }
    }
}
