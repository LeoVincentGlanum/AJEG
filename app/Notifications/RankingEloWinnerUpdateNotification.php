<?php

namespace App\Notifications;

use App\Models\Elo;
use App\Models\Game;
use App\Models\GamePlayer;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RankingEloWinnerUpdateNotification extends Notification
{
    use Queueable;

    public string $message;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(public User $winner)
    {
        $this->message = trans('elo_updated');
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
        $elo = Elo::query()
            ->where('user_id', $this->winner->id)
            ->where('sport_id', 1)->first();

        return (new MailMessage)
            ->greeting('Hello!')
            ->line('Votre elo a augmenté suite à votre victoire !')
            ->line('Nouvel elo : ' . $elo->elo)
            ->line("Merci d'utiliser notre application!");
    }
}
