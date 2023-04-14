<?php

namespace App\Http\Livewire\Chess\Game;

use App\Enums\SportEnum;
use App\Http\Livewire\Chess\Game\Traits\HasBetMapperChess;
use App\Http\Livewire\Traits\HasToast;
use App\Models\Game;
use App\Models\User;
use App\Notifications\GameInvitationNotification;
use App\Notifications\GameInvitationNotificationSended;
use App\Notifications\NewBetNotification;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Form extends Component
{
    use HasBetMapperChess;
    use HasToast;

    public string $name = '';

    public int $playerOneId = 0;

    public int $playerTwoId = 0;

    public string $date = '';

    public bool $isRanked = true;

    public bool $sendReminder = true;

    public bool $betAvailable = true;

    public array $rules = [
        'name' => 'nullable',
        'playerOneId' => 'required|exists:'.User::class.',id',
        'playerTwoId' => 'required|exists:'.User::class.',id',
        'date' => 'required',
    ];

    public function getPlayersProperty(): array|Collection
    {
        return User::query()->pluck('name', 'id') ?? [];
    }

    public function save()
    {
        $this->validate();

        try {
            $game = Game::query()->create([
                'created_by' => Auth::id(),
                'bet_available' => $this->betAvailable,
                'sport_id' => SportEnum::Chess->value,
            ]);

            $player1 = $game->gamePlayers()->create([
                'user_id' => $this->playerOneId,
                'color' => 'white',
            ]);

            $player2 = $game->gamePlayers()->create([
                'user_id' => $this->playerTwoId,
                'color' => 'white',
            ]);

            $this->calcBetRatio([$player1, $player2]);

            if ($this->betAvailable){
                $usersBetNotif = User::query()
                    ->whereNotIn('id', [$this->playerOneId, $this->playerTwoId])
                    ->where('bet_notif','=',true)
                    ->get();

                foreach ($usersBetNotif as $user){
                    $user->notify(new NewBetNotification($game));
                }
            }

            foreach ([$player1, $player2] as $user) {
                if ($user['id'] === Auth::id()) {
                    $user = User::query()
                        ->where('id', $user['id'])
                        ->first();

                    $user->notify(new GameInvitationNotificationSended($game));
                }

                if ($user['id'] !== Auth::id()) {
                    $user = User::query()
                        ->where('id', $user['id'])
                        ->first();

                    $user->notify(new GameInvitationNotification($game));
                }
            }

            $this->successToast('Votre partie a bien été créée');

            return redirect()->route('chess.dashboard');
        } catch (\Throwable $e) {
            report($e);
            $this->errorToast('An error occurred during the drafting of the game');
        }
    }

    public function render()
    {
        return view('livewire.chess.game.form');
    }
}
