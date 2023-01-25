<?php

namespace App\Notifications;

use App\Models\Elo;
use App\Models\GamePlayer;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RankingEloUpdateNotification extends Notification
{
    use Queueable;

    public string $message;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(public User $looser)
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
            ->where('user_id', $this->looser->id)
            ->where('sport_id', 1)->first();

        return (new MailMessage)
            ->greeting('Hello!')
            ->line('Votre elo a baissé suite à votre défaite !')
            ->line($this->looser)
            ->line('Nouvel elo : ' . $elo->elo)
            ->line("Merci d'utiliser notre application!");
    }
}
