<?php

namespace App\Http\Livewire\Notifications;

use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Illuminate\Notifications\Messages\MailMessage;
use LivewireUI\Modal\ModalComponent;
use App\Mail\DeleteGameNotification;
use Illuminate\Support\Facades\Mail;
class DeleteGameRequest extends ModalComponent
{

    public function RequestDeleteNotification()
    {
        Log::info('avant Envoie');

        Mail::to('florian@glanum.com')->send(new DeleteGameNotification());
//        try {
//            $this->gameType->delete();
//            $this->dispatchBrowserEvent('toast', ['message' => 'Le type à bien été supprimé', 'type' => 'success']);
//
//        } catch (\Exception $e) {
//            $this->dispatchBrowserEvent('toast', ['message' => $e->getMessage(), 'type' => 'error']);
//        }
//
//        $this->closeModalWithEvents([ListGameType::getName() => ['refreshListGameType', [$this->gameType]]]);

    }
    public function render()
    {
        return view('livewire.notifications.delete-game-request');
    }
}
