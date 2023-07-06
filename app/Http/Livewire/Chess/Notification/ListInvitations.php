<?php

namespace App\Http\Livewire\Chess\Notification;

use App\Enums\GameStatusEnum;
use App\Http\Livewire\Traits\HasToast;
use App\Models\Game;
use App\Models\GamePlayer;
use App\ModelStates\GameStates\GameAccepted;
use App\ModelStates\GameStatus;
use App\ModelStates\PlayerParticipationStates\Accepted;
use App\ModelStates\PlayerParticipationStates\Declined;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ListInvitations extends Component
{
    use HasToast;

    public function getInvitationsProperty()
    {
        return GamePlayer::query()
            ->with(['game'])
            ->where('user_id', '=', Auth::id())
            ->where('player_participation_validation', '=', 'pending')
            ->get();
    }

    public function acceptInvitation(GamePlayer $invitation)
    {
        try {
            $game = Game::query()
                ->where('id', $invitation->game_id)
                ->with('gamePlayers')
                ->first();

            $invitation->player_participation_validation->transitionTo(Accepted::class);

            // Vérifier que la transition a été effectuée
            $expectedState = GameAccepted::class;
            $isTransitionSuccessful = $invitation->player_participation_validation instanceof $expectedState;

//            if ($isTransitionSuccessful) {
                // La transition vers l'état 'Accepted' s'est bien produite
                $this->dispatchBrowserEvent('toast', [
                    'message' => __('You accepted the invitation!'),
                    'type' => 'success'
                ]);

            $this->changeStatusGame($game->id);

        }catch (\Exception $e) {
            dd($e);
        }
    }

    public function declineInvitation(GamePlayer $invitation)
    {
        $invitation->player_participation_validation->transitionTo(Declined::class);

        $this->dispatchBrowserEvent('toast', [
            'message' => __('You declined the invitation !'),
            'type' => 'success'
        ]);
    }

    /**
     * @param \Illuminate\Database\Eloquent\Model|object|\Illuminate\Database\Eloquent\Builder|null $game
     * @return \Exception
     */
    public function changeStatusGame($game_id)
    {
        $game = Game::query()->where('id', $game_id)->first();
        if ($game->gamePlayers[0]->player_participation_validation == 'accepted') {
            if ($game->gamePlayers[1]->player_participation_validation == 'accepted') {
                $game->status->transitionTo(GameAccepted::class);

                $this->dispatchBrowserEvent('toast', [
                    'message' => __('All players accepted the invitation!'),
                    'type' => 'success'
                ]);
            }
        }
    }

    public function render()
    {
        return view('livewire.chess.notification.list-invitations');
    }
}
