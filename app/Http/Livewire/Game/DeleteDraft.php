<?php

namespace App\Http\Livewire\Game;

use App\Models\Game;
use Livewire\Component;
use Illuminate\Support\Facades\Log;
use LivewireUI\Modal\ModalComponent;
use App\Http\Livewire\Traits\HasToast;

class DeleteDraft  extends ModalComponent
{

    use HasToast;
    public Game $game;

    public function mount(int $id){
        $this->game = Game::find($id);
    }

    public function delete(){

         try {
            $this->game->delete();
            $this->successToast('the game has been deleted');
            $this->closeModal();
        } catch (\Throwable $e) {
            Log::error($e->getMessage() . $e->getTraceAsString());
            $this->errorToast('An error occurred while deleting this game');
        }

    }

    public function render()
    {
        return view('livewire.game.delete-draft');
    }
}
