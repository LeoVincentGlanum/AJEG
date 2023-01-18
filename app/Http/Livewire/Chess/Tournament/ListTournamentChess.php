<?php

namespace App\Http\Livewire\Chess\Tournament;

use App\Enums\TournamentStatusEnum;
use App\Enums\TournamentTypeEnum;
use App\Http\Livewire\Traits\HasToast;
use App\Models\Game;
use App\Models\GamePlayer;
use App\Models\GameType;
use App\Models\Tournament;
use App\Models\TournamentParticipant;
use App\Models\User;
use App\ModelStates\GameStates\GameAccepted;
use App\ModelStates\PlayerParticipationStates\Accepted;
use App\ModelStates\TournamentStatusStates\StartedTournament;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ListTournamentChess extends Component
{
    use WithPagination, HasToast;


    protected $listeners = ['refreshListTournament'];

    public string $type = '';

    public string $gameType = '';

    public string $tournamentStatus = '';

    public int $minElo = 0;

    public int $maxElo = 7000;

    public function getTypesProperty(): array
    {
        return TournamentTypeEnum::cases();
    }

    public function getGameTypesProperty(): Collection
    {
        return GameType::all();
    }

    public function getStatusProperty(): array
    {
        return TournamentStatusEnum::cases();
    }

    public function refreshListTournament()
    {
        $this->makeQueryFilter();
    }

    public function makeQueryFilter()
    {
//        dd($this);
        return Tournament::query()
            ->with(['organizer', 'gameType', 'participants', 'winner'])
            ->when($this->type !== '',
                fn($query) => $query->whereType('type', TournamentTypeEnum::mapWithStateMachine($this->type))
            )
            ->when($this->gameType !== '',
                fn($query) => $query->where('game_type_id', '=', $this->gameType)
            )
            ->when($this->tournamentStatus !== '',
                fn($query) => $query->where('status', $this->tournamentStatus)
            )
            ->when($this->minElo !== 0 && $this->maxElo !== 7000,
                fn($query) => $query->where('elo_min', '>=', $this->minElo)->where('elo_max', '<=', $this->maxElo)
            )
            ->when($this->minElo === 0 && $this->maxElo !== 7000,
                fn($query) => $query->where('elo_max', '<=', $this->maxElo)
            )
            ->when($this->minElo !== 0 && $this->maxElo === 7000,
                fn($query) => $query->where('elo_min', '>=', $this->minElo)
            );
    }


    public function startTournament($id)
    {
        // Récupération des participants du tournoi
        $participants = TournamentParticipant::query()->where("tournament_id", $id)->pluck("user_id");
        // Initialiser un tableau pour stocker les matchs
        $participantsCount = $participants->count();

        // Boucle à travers tous les participants
        for ($i = 0; $i < $participantsCount; $i++) {
            // Boucle à travers les participants restants après le participant actuel
            for ($j = $i + 1; $j < $participantsCount; $j++) {
                // Ajouter le match entre les deux participants au tableau des matchs
                $matchs[] = array("player1" => $participants[$i], "player2" => $participants[$j]);
            }
        }

        // Boucle à travers tous les matchs
        $count = 1;
        foreach ($matchs as $match) {
            $game = new Game();
            $game->bet_available = 1;
            $game->label = "Tournoi n°" . $id . ", partie n°" . $count;
            $game->created_by = Auth::id();
            $game->tournament_id = $id;
            $game->status->transitionTo(GameAccepted::class);
            $game->save();

            //calcul des ratio en fonction de l'elo
            $player1 = User::query()->where("id", $match['player1'])->firstOrFail();
            $player2 = User::query()->where("id", $match['player2'])->firstOrFail();
            $ratioPlayer2 = ($player1->elo_chess / $player2->elo_chess) + 1;
            $ratioPlayer1 = ($player2->elo_chess / $player1->elo_chess) + 1;

            //Couleur blanche donnée au joueur ayant le elo le plus faible
            if ($player1->elo_chess >= $player2->elo_chess) {
                $colorPlayer1 = "noir";
                $colorPlayer2 = "blanc";
            } else {
                $colorPlayer1 = "blanc";
                $colorPlayer2 = "noir";
            }

            // Ajout des joueurs au match
            $gamePlayer1 = new GamePlayer();
            $gamePlayer1->game_id = $game->id;
            $gamePlayer1->user_id = $match['player1'];
            $gamePlayer1->bet_ratio = $ratioPlayer1;
            $gamePlayer1->color = $colorPlayer1;
            $gamePlayer1->player_participation_validation->transitionTo(Accepted::class);
            $gamePlayer1->save();
            $gamePlayer2 = new GamePlayer();
            $gamePlayer2->game_id = $game->id;
            $gamePlayer2->user_id = $match['player2'];
            $gamePlayer2->bet_ratio = $ratioPlayer2;
            $gamePlayer2->color = $colorPlayer2;
            $gamePlayer2->player_participation_validation->transitionTo(Accepted::class);
            $gamePlayer2->save();

            $count++;
        }
        //Changement du statut du championnat
        $tournament = Tournament::query()->where('id', $id)->firstOrFail();
        $tournament->status->transitionTo(StartedTournament::class);
        $tournament->save();

        $this->successToast('The tournament has started, all games have been created');
    }

    public function resetFilter()
    {
        $this->reset(['type', 'gameType', 'tournamentStatus', 'minElo', 'maxElo']);
        $this->goToPage(1);
    }

    public function render()
    {
        return view('livewire.chess.tournament.list-tournament-chess', [
            'tournaments' => $this->makeQueryFilter()->paginate(10)
        ]);
    }
}
