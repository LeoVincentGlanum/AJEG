<?php

namespace App\Http\Livewire\Chess\Notifications;

use App\Http\Livewire\Chess\Game\Traits\HasBetMapperChess;
use App\Models\Game;
use LivewireUI\Modal\ModalComponent;

class DeleteGameRequestChess extends ModalComponent
{
    use HasBetMapperChess;
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
            redirect()->route('chess.dashboard');

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
