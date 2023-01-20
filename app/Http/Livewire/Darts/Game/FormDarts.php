<?php

namespace App\Http\Livewire\Darts\Game;

use App\Actions\CreateNotificationAction;
use App\Actions\SendNotificationAction;
use App\Enums\GameResultEnum;
use App\Enums\GameStatusEnum;
use App\Http\Livewire\Darts\Game\Traits\HasBetMapperDarts;
use App\Models\Game;
use App\Models\GamePlayer;
use App\Models\GameType;
use App\Models\Notification;
use App\Models\User;
use App\ModelStates\GameStates\PlayersValidation;
use App\ModelStates\GameStates\ResultValidations;
use App\ModelStates\PlayerParticipationStates\Accepted;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class FormDarts extends Component
{
    use HasBetMapperDarts;

    public Collection $users;
    public Collection $notifications;
    public ?Collection $gameTypes;
    public ?string $type = "waiting";
    public ?string $resultat = "none";

    public ?array $playersId = [];

    public ?string $partyName = "";

    public ?bool $selectedBets = false;

    protected $messages = [
        'resultat.required' => 'Merci de saisir le resultat de la partie',
        'resultat.not_in' => 'Merci de saisir le resultat de la partie'
    ];

    public function mount(?Game $game = null)
    {
        if ($game !== null) {
            $this->partyName = $game->label;
            $this->playersId = $game->users->pluck('id')->toArray();

        }
        $this->users = User::all();
        $this->notifications = Notification::all();
        $this->gameTypes = GameType::all();
    }


    public function gotto()
    {
        return redirect("darts.dashboard");
    }

    public function saveDraft()
    {
        $validated = $this->validate([
            'partyName' => 'required',
        ], [
            'partyName.required' => 'Ce champ est requis'
        ]);

        $newGame = new Game();
        $newGame->label = $this->partyName;
        $newGame->created_by = Auth::id();
        $newGame->sport_id = 2;
        $newGame->bet_available = $this->selectedBets;
        $newGame->save();
        foreach ($this->playersId as $id) {

            $result = null;

            if ($this->type == GameStatusEnum::ended) {
                $result = GameResultEnum::lose->value;
                if ($this->resultat == GameResultEnum::nul || $this->resultat == GameResultEnum::pat) {
                    $result = $this->resultat;
                }

                if ($this->resultat == $id) {
                    $result = GameResultEnum::win->value;
                }
            }

            $gameplayer = new GamePlayer();
            $gameplayer->game_id = $newGame->id;
            $gameplayer->user_id = $id;
            $gameplayer->result = $result;
            $gameplayer->save();

            $this->dispatchBrowserEvent('toast', ['message' => 'Le brouillon à été enregisté.', 'type' => 'success']);

            redirect()->route('darts.dashboard');
        }
    }

    public function rules()
    {
        $arrayRules = [];
        if (count($this->playersId) > 1) {
            return [
                'playersId' => 'required|array|size:' . count($this->playersId),
            ];
        }

        if ($this->type === "Terminé") {
            $arrayRules['resultat'] = "required|not_in:none";
        }

        return $arrayRules;
    }

    public function submit(CreateNotificationAction $createNotificationAction, SendNotificationAction $sendNotificationAction)
    {

        $this->validate();

        $newGame = new Game();
        $newGame->label = $this->partyName;
        $newGame->created_by = Auth::id();
        $newGame->bet_available = $this->selectedBets;
        $newGame->sport_id = 2;
        $newGame->save();

        $match = match ($this->type) {
            GameStatusEnum::waiting->name => $newGame->status->transitionTo(PlayersValidation::class),
            GameStatusEnum::ended->name => $newGame->status->transitionTo(ResultValidations::class)
        };


        foreach ($this->playersId as $id) {
            $result = null;

            if ($this->type == GameStatusEnum::ended->value) {
                $result = GameResultEnum::lose->value;
                if ($this->resultat == GameResultEnum::nul || $this->resultat == GameResultEnum::pat) {
                    $result = $this->resultat;
                }

                if ($this->resultat == $id) {
                    $result = GameResultEnum::win->value;
                }
            }

            $gameplayer = new GamePlayer();
            $gameplayer->game_id = $newGame->id;
            $gameplayer->user_id = $id;
            if ($id == Auth::id()) {
                $gameplayer->player_participation_validation->transitionTo(Accepted::class);
            }
            $gameplayer->result = $result;

            $gameplayer->save();
        }

        $users = User::query()->whereIn('users.id', $this->playersId)->join('elo', function ($join) {
            $join->on('users.id', '=', 'elo.user_id')->where('elo.sport_id', 2);
        })->orderBy('elo.elo')->get();
        $this->calcBetRatio($users);
        if ($this->type == GameStatusEnum::waiting->value) {
            session()->flash('message_url', route('darts.game.show-darts', ['game' => $newGame->id]));
            session()->flash('message', 'Votre partie a bien été créée. Un email a été envoyé au(x) joueur(s) pour les avertir.');

            $creator = Auth::id();
            $type = 'Création de partie';
            $message = 'Vous avez été invité a rejoindre une partie';


            $notification = $createNotificationAction->execute($creator, $type, $message);
            //dd($notification,$this->>$this->playersId);
            foreach ($this->playersId as $id) {
                if ((int)$id != Auth::id()) {
                    $sendNotificationAction->execute($notification->id, $id);
                }
            }

            return redirect()->route('darts.dashboard');

        }

        session()->flash('message', 'Votre partie a bien été créée.');
        return redirect()->route('darts.dashboard');

    }

    public function render()
    {
        return view('livewire.darts.game.form-darts');
    }
}
