<?php

namespace App\Http\Livewire\Tournament;

use App\Enums\TournamentStatusEnum;
use App\Http\Livewire\Traits\HasToast;
use App\Models\Game;
use App\Models\GamePlayer;
use App\Models\Tournament;
use App\Models\TournamentParticipant;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use LivewireUI\Modal\ModalComponent;

class Start extends ModalComponent
{
    use HasToast;

    public ?Tournament $tournament;

    public ?User $user;

    public function mount($id)
    {
        try {
            // Récupération des participants du tournoi
            $this->participants = TournamentParticipant::query()->where("tournament_id", $id)->pluck("user_id");
            // Initialiser un tableau pour stocker les matchs
            $matches = [];
            $participantsCount = $this->participants->count();

            // Boucle à travers tous les participants
            for ($i = 0; $i < $participantsCount; $i++) {
                // Boucle à travers les participants restants après le participant actuel
                for ($j = $i + 1; $j < $participantsCount; $j++) {
                    // Ajouter le match entre les deux participants au tableau des matchs
                    $matches[] = array("player1" => $this->participants[$i], "player2" => $this->participants[$j]);
                }
            }

            // Boucle à travers tous les matchs
            foreach ($matches as $match) {
                $game = new Game();
                $game->bet_avaible = 1;
                $game->label = "Tournoi n°" . $id . ", partie n°";
                $game->created_by = Auth::id();
                $game->tournament_id = $id;
                $game->save();
                // Ajout des joueurs au match
                $gamePlayer1 = new GamePlayer();
                $gamePlayer1->game_id = $game->id;
                $gamePlayer1->user_id = $match['player1'];
                $gamePlayer1->save();
                $gamePlayer2 = new GamePlayer();
                $gamePlayer2->game_id = $game->id;
                $gamePlayer2->user_id = $match['player2'];
                $gamePlayer2->save();
            }


        } catch (\Throwable $e) {
            report($e);

        }
    }

    // Fonction pour calculer le nombre de matchs
    public function calculate_matches($num_participants)
    {
        // Calculer le nombre de matchs en utilisant la formule (n * (n - 1)) / 2
        return ($num_participants * ($num_participants - 1)) / 2;
    }

    public function render()
    {
        return view('livewire.tournament.start');
    }
}
