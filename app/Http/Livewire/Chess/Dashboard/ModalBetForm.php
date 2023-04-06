<?php

namespace App\Http\Livewire\Chess\Dashboard;

use App\Http\Livewire\Traits\HasToast;
use App\Models\Bet;
use App\Models\Game;
use App\Models\User;
use App\ModelStates\BetStates\PendingBet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use LivewireUI\Modal\ModalComponent;

class ModalBetForm extends ModalComponent
{
    use HasToast;

    public ?Game $game;

    public array $bets = [];

    public function mount(int $gameId)
    {
        try {
            $this->game = Game::query()
                ->with(['bets', 'gamePlayers', 'gamePlayers.user', 'gamePlayers.user.elos' => function($query){
                    $query->where('sport_id', '=', 1);
                }])
                ->findOrFail($gameId);
        } catch (\Throwable $e) {
            report($e);
            $this->game = null;
            $this->errorToast('An error occurred while retrieving the game');
        }
    }

    public function save()
    {
        DB::beginTransaction();
        try {
            $user = User::query()->find(Auth::id());
            if (array_sum($this->bets) === 0) {
                $this->errorToast('The total amount of your bets must be greater than 0');
                return;
            }

            if (array_sum($this->bets) > $user->coins) {
                $this->errorToast('You don\'t have enough coins');
                return;
            }

            foreach ($this->bets as $playerId => $amount) {
                Bet::query()->create([
                    'game_id' => $this->game->id,
                    'gambler_id' => $user->id,
                    'gameplayer_id' => $playerId,
                    'bet_deposit' => $amount,
                    'bet_gain' => $amount * $this->game->gamePlayers()->find($playerId)->bet_ratio,
                ]);

                $user->update([
                    'coins' => $user->coins - $amount
                ]);
            }

            DB::commit();
            $this->successToast('Your bets have been registered');
            $this->closeModalWithEvents([
                ListOngoingGames::getName() => 'refreshList',
                ListOngoingBets::getName() => 'refreshList',
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);
            $this->errorToast('An error occurred while creating the bet');
        }
    }

    public function render()
    {
        return view('livewire.chess.dashboard.modal-bet-form');
    }
}
