<?php

namespace App\Http\Livewire\Darts\Notifications;

use App\Http\Livewire\Darts\Game\Traits\HasBetMapperDarts;
use App\Models\Game;
use LivewireUI\Modal\ModalComponent;

class DeleteGameRequestDarts extends ModalComponent
{
    use HasBetMapperDarts;
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
            redirect()->route('darts.dashboard');

        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('toast', ['message' => $e->getMessage(), 'type' => 'error']);

            report($e);
        }
//
//        $this->closeModalWithEvents([ListGameType::getName() => ['refreshListGameType', [$this->currentGame]]]);

    }

    public function render()
    {
        return view('livewire.chess.notifications.delete-game-request-chess');
    }
}
