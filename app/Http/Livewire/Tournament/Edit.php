<?php

namespace App\Http\Livewire\Tournament;

use App\Enums\GameResultEnum;
use App\Enums\TournamentStatusEnum;
use App\Http\Livewire\Traits\HasToast;
use App\Models\GameType;
use App\Models\Tournament;
use App\Models\TournamentParticipant;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Edit extends Component
{
    use HasToast;

    public Tournament $tournament;

    public array $game = [];

    protected array $rules = [
        'tournament.name' => 'required|string|max:255',
        'tournament.number_of_players' => 'required',
        'tournament.entrance_fee' => 'required',
        'tournament.game_type_id' => 'required',
        'game.player1.id' => 'required',
        'game.player1.result' => 'required',
        'game.player2.id' => 'required',
        'game.player2.result' => 'required'
    ];

    protected array $messages = [
        'tournament.name.required' => 'The tournament name is required',
        'tournament.number_of_players.required' => 'The number of players is required',
        'tournament.entrance_fee.required' => 'The entrance fee is required',
    ];

    protected array $rulesInformations = [
        'tournament.name' => 'required|string|max:255',
        'tournament.number_of_players' => 'required',
        'tournament.entrance_fee' => 'required',
        'tournament.game_type_id' => 'required'
    ];

    protected array $rulesResults = [
        'game.player1.id' => 'required',
        'game.player1.result' => 'required',
        'game.player2.id' => 'required',
        'game.player2.result' => 'required'
    ];


    public function getGameTypesProperty(): Collection
    {
        return GameType::all();
    }

    public function getPlayersProperty(): Collection
    {
        return $this->tournament->participants;
    }

    public function mount(Tournament $tournament)
    {
        $this->tournament = $tournament;
    }

    public function cancel()
    {
        try {
            $this->tournament->update([
                'status' => TournamentStatusEnum::canceled->value,
            ]);

            $this->successToast('The tournament has been cancelled');
        } catch (\Throwable $e) {
            Log::error($e->getMessage());
            $this->errorToast('An error occurred while cancelling the tournament');
        }
    }

    public function start()
    {
        try {
            $this->tournament->update([
                'status' => TournamentStatusEnum::progress->value,
                'start_date' => now(),
            ]);

            $this->successToast('The tournament has been started');
        } catch (\Throwable $e) {
            Log::error($e->getMessage());
            $this->errorToast('An error occurred while launching the tournament');
        }
    }

    public function saveInformations()
    {
        $this->validate($this->rulesInformations);

        try {
            $this->tournament->save();

            $this->successToast('The tournament has been modified');
        } catch (\Throwable $e) {
            Log::error($e->getMessage());
            $this->errorToast('An error occurred while updating the tournament');
        }
    }

    public function saveResults()
    {
        $this->validate($this->rulesResults);

        DB::beginTransaction();
        try {
            foreach ($this->game as $playerResult) {
                $participant = $this->tournament
                    ->participants()
                    ->where('user_id', '=', Arr::get($playerResult, 'id'))
                    ->first();

                $result = Arr::get($playerResult, 'result');
                match ($result) {
                    GameResultEnum::win->value => $participant->pivot->wins += 1,
                    GameResultEnum::lose->value => $participant->pivot->losses += 1,
                    GameResultEnum::pat->value => $participant->pivot->pats += 1,
                    GameResultEnum::nul->value => $participant->pivot->draws += 1
                };

                $participant->pivot->save();
            }

            DB::commit();
            $this->successToast('The result has been registered');
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            $this->errorToast('An error occurred while entering the result');
        }
    }

    public function render()
    {
        return view('livewire.tournament.edit');
    }
}
