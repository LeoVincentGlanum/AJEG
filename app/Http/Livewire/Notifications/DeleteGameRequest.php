<?php

namespace App\Http\Livewire\Notifications;

use App\Http\Livewire\Game\Traits\HasBetMapper;
use App\Models\Bet;
use App\Models\Game;
use App\Models\User;
use LivewireUI\Modal\ModalComponent;

class DeleteGameRequest extends ModalComponent
{
    use HasBetMapper;
    public Game $currentGame;

    public function mount(int $game)
    {
        $this->currentGame = Game::find($game);

    }

    public function RequestDeleteNotification()
    {
//        Log::info('avant Envoie');
//
//        Mail::to('florian@glanum.com')->send(new DeleteGameNotification());


        try {
            $this->cashOutAllGambler();
            $this->currentGame->delete();
            $this->dispatchBrowserEvent('toast', ['message' => 'La partie à bien été supprimé', 'type' => 'success']);

        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('toast', ['message' => $e->getMessage(), 'type' => 'error']);

            report($e);
        }
//
//        $this->closeModalWithEvents([ListGameType::getName() => ['refreshListGameType', [$this->currentGame]]]);

    }

    public function render()
    {
        return view('livewire.notifications.delete-game-request');
    }
}
