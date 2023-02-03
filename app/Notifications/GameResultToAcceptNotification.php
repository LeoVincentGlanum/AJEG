<?php

namespace App\Notifications;

use App\Models\Game;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class GameResultToAcceptNotification extends Notification
{
    use Queueable;

    public string $message;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(public Game $game)
    {
        $this->message = trans('result_game_to_accept');
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database','mail'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'message' => $this->message,
            'game_id' => $this->game->id
        ];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->greeting('Hello!')
            ->line("Le résultat de la partie " . $this->game->label . " a été envoyé, validez le résultat que votre adversaire a rentré.")
            ->action("Voir la partie et Valider le résultat", route('chess.game.show-chess',['game' => $this->game->id]))
            ->line("Merci d'utiliser notre application!");
    }
}
