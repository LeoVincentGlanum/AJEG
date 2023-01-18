<?php

namespace App\Http\Livewire\Tournament;

use App\Enums\TournamentStatusEnum;
use App\Http\Livewire\Traits\HasToast;
use App\Models\Tournament;
use App\Models\TournamentParticipant;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use LivewireUI\Modal\ModalComponent;

class Register extends ModalComponent
{
    use HasToast;

    public ?Tournament $tournament;

    public ?User $user;

    public function mount($id)
    {
        try {
            $this->tournament = Tournament::query()->with(['participants'])->findOrFail($id);
            $this->user = User::query()->findOrFail(Auth::id());
        } catch (\Throwable $e) {
            report($e);
            $this->tournament = null;
        }
    }

    public function register()
    {
        $nbParticipants = $this->tournament->participants->count();

        if ($nbParticipants >= $this->tournament->number_of_players) {
            $this->errorToast('The tournament is full');
            return;
        }

        if ($this->tournament->participants->where('id', '=', $this->user->id)->isNotEmpty()) {
            $this->errorToast('You are already registered');
            return;
        }

        if ($this->tournament->entrance_fee > $this->user->coins) {
            $this->errorToast('You don\'t have enough coins');
            return;
        }

        if ($this->tournament->elo_max !== null && $this->tournament->elo_max < $this->user->elo_chess) {
            $this->errorToast('Your elo chess is too high');
            return;
        }

        if ($this->tournament->elo_min > $this->user->elo_chess) {
            $this->errorToast('Your elo chess isn\'t high enough');
            return;
        }

        DB::beginTransaction();
        try {
            $newParticipation = new TournamentParticipant();
            $newParticipation->tournament_id = $this->tournament->id;
            $newParticipation->user_id = $this->user->id;
            $newParticipation->save();

            $this->user->coins = $this->user->coins - $this->tournament->entrance_fee;
            $this->user->save();

            if ($this->tournament->participants->count() + 1 === $this->tournament->number_of_players) {
                $this->tournament->status = TournamentStatusEnum::full->value;
                $this->tournament->save();
            }

            $this->successToast('Your registration has been successful');
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);
            $this->errorToast('An error occurred during your registration');
        }

        $this->closeModalWithEvents([ListTournament::getName() => ['refreshListTournament', []]]);
    }

    public function render()
    {
        return view('livewire.chess.tournament.register');
    }
}
