<?php

namespace App\Http\Livewire\Chess\Game;

use App\Actions\CreateNotificationAction;
use App\Actions\SendNotificationAction;
use App\Enums\GameResultEnum;
use App\Enums\GameStatusEnum;
use App\Http\Livewire\Chess\Game\Traits\HasBetMapperChess;
use App\Http\Livewire\Traits\HasToast;
use App\Models\Elo;
use App\Models\Game;
use App\Models\GamePlayer;
use App\Models\GameType;
use App\Models\Notification;
use App\Models\User;
use App\ModelStates\GamePlayerResultState;
use App\ModelStates\GamePlayerResultStates\Draw;
use App\ModelStates\GamePlayerResultStates\Loss;
use App\ModelStates\GamePlayerResultStates\Pat;
use App\ModelStates\GamePlayerResultStates\PendingResult;
use App\ModelStates\GamePlayerResultStates\Win;
use App\ModelStates\GameStates\Draft;
use App\ModelStates\GameStates\PlayersValidation;
use App\ModelStates\GameStates\ResultValidations;
use App\ModelStates\PlayerRecognitionResultStates\Pending;
use App\Notifications\GameInvitationNotification;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;
use App\ModelStates\PlayerParticipationStates\Accepted;

class FormChess extends Component
{
    use HasBetMapperChess;
    use HasToast;

    public ?string $partyName = '';

    public $status = PlayersValidation::class;

    public ?array $players = [];

    public int $selectedGameTypeId = 1;

    public ?bool $betAvailable = false;

    public ?Game $game = null;

    protected array $rules = [
        'partyName' => 'required',
        'selectedGameTypeId' => 'required',
        'players.*.id' => 'required',
        'players.*.color' => 'required',
        'players.*.result' => 'sometimes|required',
        'betAvailable' => 'required',
    ];

    protected array $messages = [
        'partyName.required' => 'The game name is required',
        'selectedGameTypeId.required' => 'The game type is required',
        'players.*.id.required' => 'The players are required',
        'players.*.color.required' => 'The players color are required',
        'players.*.result.required' => 'The results are required',
        'betAvailable.required' => 'The bet availability is required',
    ];

    public function getUsersProperty(): Collection
    {
        return User::all();
    }

    public function getNotificationsProperty(): Collection
    {
        return Notification::all();
    }

    public function getGameTypesProperty(): Collection
    {
        return GameType::all();
    }

    public function getColorsProperty(): array
    {
        return ['black' => 'Black', 'white' => 'White'];
    }

    public function mount(?Game $game = null)
    {
        $this->game = new Game();

        if ($game !== null) {
            $this->game = $game;

            $this->partyName = $game->label;
            $game->gamePlayers()->each(function ($player, $key) {
                $this->players[$key]['id'] = $player->user_id;
                $this->players[$key]['color'] = $player->color;
            });
        }
    }

    public function saveDraft()
    {
        $this->validateOnly('partyName');

        try {
            $this->game->label = $this->partyName;
            $this->game->created_by = Auth::id();
            $this->game->sport_id = 1;
            $this->game->save();

            $this->game->gamePlayers()->delete();
            foreach ($this->players as $player) {
                $result = PendingResult::class;

                if ($this->status === ResultValidations::class) {
                    $result = Arr::get($player, 'result');
                }

                $gameplayer = new GamePlayer();
                $gameplayer->game_id = $this->game->id;
                $gameplayer->user_id = Arr::get($player, 'id');
                $gameplayer->color = Arr::get($player, 'color');
                $gameplayer->result = $result;
                $gameplayer->save();
            }

            $this->successToast('Le brouillon à été enregisté');

            return redirect()->route('chess.dashboard');
        } catch (\Throwable $e) {
            report($e);
            $this->errorToast('An error occurred during the drafting of the game');
        }
    }

    public function save()
    {
        $this->validate();

        try {
            $this->game->label = $this->partyName;
            $this->game->created_by = Auth::id();
            $this->game->bet_available = $this->betAvailable;
            $this->game->sport_id = 1;
            $this->game->save();

            if ($this->status === PlayersValidation::class) {
                $this->game->status->transitionTo(PlayersValidation::class);
            }

            if ($this->status === ResultValidations::class) {
                $this->game->status->transitionTo(ResultValidations::class);
            }

            $this->game->gamePlayers()->delete();
            foreach ($this->players as $player) {
                $result = null;

                if ($this->status === ResultValidations::class) {
                    $result = Arr::get($player, 'result');
                }

                $gameplayer = new GamePlayer();
                $gameplayer->game_id = $this->game->id;
                $gameplayer->user_id = Arr::get($player, 'id');
                $gameplayer->color = Arr::get($player, 'color');

                if (Arr::get($player, 'id') === Auth::id() || $this->status === ResultValidations::class) {
                    $gameplayer->player_participation_validation->transitionTo(Accepted::class);
                }

                if ($result !== null) {
                    $gameplayer->result = $result;
                }

                $gameplayer->save();
            }

            $users = User::query()
                ->addSelect([
                    'elo' => Elo::select('elo')
                        ->whereColumn('user_id', 'users.id')
                        ->where('sport_id', 1),
                ])
                ->whereIn('users.id', Arr::pluck($this->players, 'id'))
                ->get();

            $this->calcBetRatio($users->toArray());

            $this->successToast('Votre partie a bien été créée');

            return redirect()->route('chess.dashboard');
        } catch (\Throwable $e) {
            report($e);
            $this->errorToast('An error occurred during the drafting of the game');
        }
    }

    public function render()
    {
        return view('livewire.chess.game.form-chess');
    }
}
