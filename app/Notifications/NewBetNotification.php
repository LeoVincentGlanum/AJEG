<?php

namespace App\Notifications;

use App\Models\Game;
use Illuminate\Support\Arr;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewBetNotification extends Notification
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
        $this->message = trans('new_bet');
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
            'game' => $this->game
        ];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $arrayGamePlayer = $this->game->gamePlayers;
        $arrayGameUsers = $this->game->users;

        return (new MailMessage)
            ->greeting('Hello!')
            ->line('Une nouvelle partie est ouverte aux paris ! Miser & Gagner des rosas ! ')
            ->line('La partie '.$this->game->label.' opposant :')
            ->line(Arr::get($arrayGameUsers,0)->name.' '.Arr::get($arrayGamePlayer,0)->bet_ratio.'x CONTRE '.Arr::get($arrayGameUsers,1)->name.' '.Arr::get($arrayGamePlayer,1)->bet_ratio.'x')
            ->action('Voir la partie', route('chess.game.show-chess',['game' => $this->game->id]))
            ->line("Merci d'utiliser notre application!");
    }
}
