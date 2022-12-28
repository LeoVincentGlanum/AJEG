<?php

namespace App\Http\Livewire\Tournament;

use App\Enums\TournamentStatusEnum;
use App\Http\Livewire\Traits\HasToast;
use App\Models\GameType;
use App\Models\Tournament;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use LivewireUI\Modal\ModalComponent;

class Form extends ModalComponent
{
    use HasToast;

    public Tournament $tournament;

    public string|null $selectedGameType = null;

    protected array $rules = [
        'tournament.name' => 'required|string|max:255',
        'tournament.number_of_players' => 'required',
        'tournament.entrance_fee' => 'required',
        'tournament.game_type_id' => 'required',
    ];

    public function getGameTypesProperty(): Collection
    {
        return GameType::all();
    }

    public function mount() {
        $this->tournament = new Tournament();
        $user = Auth::user();
        $this->tournament->name = "Tournoi de " . $user->name;
    }

    public function save()
    {
        $this->validate();

        try {
            $this->tournament->organizer_id = Auth::id();
            $this->tournament->status = TournamentStatusEnum::waiting->value;
            $this->tournament->save();

            $this->successToast('The tournament has been created');
        } catch (\Throwable $e) {
            report($e);

            $this->errorToast('An error occurred while creating the tournament');
        }

        $this->closeModalWithEvents([ListTournament::getName() => ['refreshListTournament', []]]);
    }

    public function render()
    {
        return view('livewire.tournament.form');
    }
}
