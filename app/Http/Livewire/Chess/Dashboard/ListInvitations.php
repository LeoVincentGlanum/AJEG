<?php

namespace App\Http\Livewire\Chess\Dashboard;

use App\Http\Livewire\Traits\HasToast;
use App\Models\GamePlayer;
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
        $invitation->player_participation_validation->transitionTo(Accepted::class);

        $this->dispatchBrowserEvent('toast', [
            'message' => __('You accepted the invitation !'),
            'type' => 'success'
        ]);
    }

    public function declineInvitation(GamePlayer $invitation)
    {
        $invitation->player_participation_validation->transitionTo(Declined::class);

        $this->dispatchBrowserEvent('toast', [
            'message' => __('You declined the invitation !'),
            'type' => 'success'
        ]);
    }

    public function render()
    {
        return view('livewire.chess.dashboard.list-invitations');
    }
}
