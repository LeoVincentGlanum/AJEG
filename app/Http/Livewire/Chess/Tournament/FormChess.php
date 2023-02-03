<?php

namespace App\Http\Livewire\Chess\Tournament;

use App\Enums\TournamentStatusEnum;
use App\Http\Livewire\Traits\HasToast;
use App\Models\GameType;
use App\Models\Tournament;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;

class FormChess extends ModalComponent
{
    use HasToast;

    public Tournament $tournament;

    public string|null $selectedGameType = null;

    protected array $rules = [
        'tournament.name' => 'required|string|max:255',
        'tournament.number_of_players' => 'required|numeric|min:2',
        'tournament.entrance_fee' => 'required|numeric|min:0',
        'tournament.game_type_id' => 'required',
        'tournament.type' => 'required',
        'tournament.elo_min' => 'nullable|numeric|min:0|lt:tournament.elo_max',
        'tournament.elo_max' => 'nullable|numeric|min:0',
    ];

    public function getGameTypesProperty(): Collection
    {
        return GameType::all();
    }

    public function mount() {
        $this->tournament = new Tournament();
        $user = Auth::user();
        $this->tournament->name = "Tournoi de " . $user->name;
        $this->tournament->entrance_fee = 0;
    }

    public function save()
    {
        $this->validate();

        try {
            $this->tournament->organizer_id = Auth::id();
            $this->tournament->status = TournamentStatusEnum::open->value;
            $this->tournament->sport_id = 1;
            $this->tournament->save();

            $this->successToast('The tournament has been created');
        } catch (\Throwable $e) {
            report($e);

            $this->errorToast('An error occurred while creating the tournament');
        }

        $this->closeModalWithEvents([ListTournamentChess::getName() => ['refreshListTournament', []]]);
    }

    public function render()
    {
        return view('livewire.chess.tournament.form-chess');
    }
}
