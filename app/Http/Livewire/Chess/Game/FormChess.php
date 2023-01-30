<?php

namespace App\Http\Livewire\Chess\Game;

use App\Enums\GameResultEnum;
use App\Enums\GameStatusEnum;
use App\Enums\SportEnum;
use App\Http\Livewire\Chess\Game\Traits\HasBetMapperChess;
use App\Http\Livewire\Traits\HasToast;
use App\Models\ChessGame;
use App\Models\Elo;
use App\Models\Game;
use App\Models\GamePlayer;
use App\Models\GameType;
use App\Models\Notification;
use App\Models\User;
use App\ModelStates\GamePlayerResultState;
use App\ModelStates\GamePlayerResultStates\PendingResult;
use App\ModelStates\GameStates\PlayersValidation;
use App\ModelStates\GameStates\ResultValidations;
use App\ModelStates\GameStatus;
use App\Notifications\GameInvitationNotification;
use App\Notifications\GameInvitationNotificationSended;
use Illuminate\Support\Arr;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;
use App\ModelStates\PlayerParticipationStates\Accepted;

class FormChess extends Component
{
    use HasBetMapperChess;
    use HasToast;

    public ?Game $game = null;

    public string $status;

    public ?array $players = [];

    public ?bool $betAvailable = false;
    public ?string $result_exist;

    protected array $rules = [
        'game.label' => 'required',
        'players.*.id' => 'required',
        'players.*.color' => 'required|different:Choisissez une couleur',
        'players.*.result' => 'sometimes|required',
        'betAvailable' => 'required',
    ];

    protected array $messages = [
        'game.label.required' => 'The game name is required',
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
        $this->game = new ChessGame();
        $this->status = GameStatusEnum::AskingForGame->value;
        $this->result_exist = '';

        if ($game !== null) {
            $this->game = $game;

            $this->partyName = $game->label;
            $game->gamePlayers()->each(function ($player, $key) {
                $this->players[$key]['id'] = $player->user_id;
                $this->players[$key]['color'] = $player->color;
                $this->players[$key]['result'] = $player->result;
            });
        }
    }

    public function saveDraft()
    {
        $this->validateOnly('game.name');

        $this->game->created_by = Auth::id();
        $this->game->save();

        $this->game->users()->sync(
            collect($this->players)
                ->mapWithKeys(fn($player) => [
                    Arr::get($player, 'id') => [
                        'color' => Arr::get($player, 'color'),
                        'result' => PendingResult::$name,
                    ]
                ]
                )->toArray()
        );

        if ($this->status === GameStatusEnum::Ended->value) {
            $this->game->gamePlayers()->each(function (GamePlayer $gamePlayer) {
                $players = collect($this->players)
                    ->mapWithKeys(fn($player) => [
                        Arr::get($player, 'id') => [
                            'color' => Arr::get($player, 'color'),
                            'result' => Arr::get($player, 'result'),
                        ]
                    ]
                    )->toArray();

                $result = Arr::get($players, $gamePlayer->user_id . '.result');

                match ($result) {
                    GameResultEnum::Win->value => $gamePlayer->result->transitionTo(GameResultEnum::toStateMachine(GameResultEnum::Win)),
                    GameResultEnum::Lose->value => $gamePlayer->result->transitionTo(GameResultEnum::toStateMachine(GameResultEnum::Lose)),
                    GameResultEnum::Pat->value => $gamePlayer->result->transitionTo(GameResultEnum::toStateMachine(GameResultEnum::Pat)),
                    GameResultEnum::Draw->value => $gamePlayer->result->transitionTo(GameResultEnum::toStateMachine(GameResultEnum::Draw)),
                    null => "pending",
                };
            });
        }

        try {
            $this->game->users()->sync(
                collect($this->players)
                    ->mapWithKeys(fn($player) => [
                        Arr::get($player, 'id') => [
                            'color' => Arr::get($player, 'color'),
                            'result' => PendingResult::$name,
                        ]
                    ]
                    )->toArray()
            );

            if ($this->status === GameStatusEnum::Ended->value) {
                $this->game->gamePlayers()->each(function (GamePlayer $gamePlayer) {
                    $players = collect($this->players)
                        ->mapWithKeys(fn($player) => [
                            Arr::get($player, 'id') => [
                                'color' => Arr::get($player, 'color'),
                                'result' => Arr::get($player, 'result'),
                            ]
                        ]
                        )->toArray();

                    $result = Arr::get($players, $gamePlayer->user_id . '.result');

                    match ($result) {
                        GameResultEnum::Win->value => $gamePlayer->result->transitionTo(GameResultEnum::toStateMachine(GameResultEnum::Win)),
                        GameResultEnum::Lose->value => $gamePlayer->result->transitionTo(GameResultEnum::toStateMachine(GameResultEnum::Lose)),
                        GameResultEnum::Pat->value => $gamePlayer->result->transitionTo(GameResultEnum::toStateMachine(GameResultEnum::Pat)),
                        GameResultEnum::Draw->value => $gamePlayer->result->transitionTo(GameResultEnum::toStateMachine(GameResultEnum::Draw)),
                        null => "pending",
                    };
                });
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
        if ($this->game->label === "" || $this->game->label === null) {
            $nbGame = Game::all()->count() + 1;
            $this->game->label = User::find(Auth::id())->name . "'s Game " . $nbGame;
        }

        $this->validate();

        try {
            $this->game->created_by = Auth::id();
            $this->game->bet_available = $this->betAvailable;
            $this->game->sport_id = SportEnum::Chess->value;

            $this->game->save();

            if ($this->status === GameStatusEnum::AskingForGame->value) {
                $this->game->status->transitionTo(PlayersValidation::class);
            }

            if ($this->status === GameStatusEnum::Ended->value) {
                $this->game->status->transitionTo(ResultValidations::class);
            }

            $this->game->gamePlayers()->delete();
            foreach ($this->players as $player) {
                $result = null;


                if ($this->status === GameStatusEnum::Ended->value) {
                    $result = Arr::get($player, 'result');
                }

                $gameplayer = new GamePlayer();
                $gameplayer->game_id = $this->game->id;
                $gameplayer->user_id = Arr::get($player, 'id');
                $gameplayer->color = Arr::get($player, 'color');

                if ($this->status === ResultValidations::class || (int)Arr::get($player, 'id') === Auth::id()) {
                    $gameplayer->player_participation_validation->transitionTo(Accepted::class);

                    if (Auth::id() === (int) $gameplayer->user_id){

                        $gameplayer->player_result_validation->transitionTo(\App\ModelStates\PlayerRecognitionResultStates\Accepted::class);
                    }

                }

                if ($result !== null) {

                    $gameplayer->result = $result;
                }


                $gameplayer->save();
            }

            $this->game->save();

            $users = User::query()
                ->addSelect([
                    'elo' => Elo::select('elo')
                        ->whereColumn('user_id', 'ajeg_users.id')
                        ->where('sport_id', 1),
                ])
                ->whereIn('ajeg_users.id', Arr::pluck($this->players, 'id'))
                ->get();

            $this->calcBetRatio($users->toArray());

            foreach ($users as $user) {
                if ($user->id === Auth::id()) {
                    $user->notify(new GameInvitationNotificationSended($this->game));
                }

                if ($user->id !== Auth::id()) {
                    $user->notify(new GameInvitationNotification($this->game));
                }
            }

            $this->successToast('Votre partie a bien été créée');

            return redirect()->route('chess.dashboard');


        } catch (\Throwable $e) {
            report($e);
            $this->errorToast('An error occurred during the drafting of the game');
        }
    }

    public function giveResult($player_id)
    {
        match ($player_id) {
            1 => $opponent_id = 0,
            0 => $opponent_id = 1
        };

        foreach ($this->players[$player_id] as $result) {
            if ($result === 'win') {
                $this->players[$opponent_id]['result'] = 'loss';
            }
            if ($result === 'loss') {
                $this->players[$opponent_id]['result'] = 'win';
            }
            if ($result === 'pat') {
                $this->players[$opponent_id]['result'] = 'pat';
            }
            if ($result === 'draw') {
                $this->players[$opponent_id]['result'] = 'draw';
            }
        }
    }

    public function giveColor($player_id)
    {
        match ($player_id) {
            1 => $opponent_id = 0,
            0 => $opponent_id = 1
        };

        foreach ($this->players[$player_id] as $result) {
            if ($result === 'white') {
                $this->players[$opponent_id]['color'] = 'black';
            }

            if ($result === 'black') {
                $this->players[$opponent_id]['color'] = 'white';
            }

            if ($result === 'Choisissez une couleur') {
                $this->players[$opponent_id]['color'] = 'Choisissez une couleur';
            }
        }
    }

    public function actualizePlayer($player_id)
    {
        $this->players[$player_id]['name'] = $this->users->where('id', $this->players[$player_id]['id'])->first()->name;
    }

    public function render()
    {
        return view('livewire.chess.game.form-chess');
    }
}
