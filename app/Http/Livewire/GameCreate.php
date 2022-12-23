<?php

namespace App\Http\Livewire;

use App\Actions\CreateNotificationAction;
use App\Actions\SendNotificationAction;
use App\Enums\GameResultEnum;
use App\Enums\GameStatusEnum;
use App\Http\Livewire\MyAccount\Notifications;
use App\Models\Notification;
use App\Models\User;
use App\Models\Game;
use App\Models\UserNotification;
use App\ModelStates\GameStates\Draft;
use App\ModelStates\GameStates\PlayersValidation;
use App\ModelStates\GameStates\ResultValidations;
use http\Env\Request;
use Livewire\Component;
use App\Models\GameType;
use App\Models\GamePlayer;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;

class GameCreate extends Component
{

    public Collection $users;
    public Collection $notifications;
    public string $type = "En attente";
    public ?Collection $gameTypes;
    public ?string $resultat = "none";
    public ?array $players = [];
    public ?string $selectBlanc = "nul";
    public ?array $playersColors = [];
    public ?string $partyName = "";

    protected $messages = [
        'selectBlanc.not_in' => 'Attention ! Merci de selectionner un joueur blanc',
        'resultat.required' => 'Merci de saisir le resultat de la partie',
        'resultat.not_in' => 'Merci de saisir le resultat de la partie'
    ];

    public function mount()
    {
        $this->users     = User::all();
        $this->notifications     = Notification::all();
        $this->gameTypes = GameType::all();
    }


    public function gotto()
    {
        return redirect("dashboard");
    }

    public function saveDraft(){

        $validated = $this->validate([
            'partyName' => 'required',
        ],[
            'partyName.required' => 'Ce champ est requis'
        ]);

        $newGame = new Game();
        $newGame->label = $this->partyName;
        $newGame->created_by = Auth::id();
        $newGame->save();
dd('?');
        foreach ($this->players as $player) {
            $color = "noir";
            if (count($this->playersColors) > 0 ){
                $color = $this->playersColors[$player];
            }
            if($this->selectBlanc == $player) {
                $color = "blanc";
            }

            $result = null;

            if ($this->type == GameStatusEnum::ended) {
                $result = GameResultEnum::lose;
                if ($this->resultat == GameResultEnum::nul || $this->resultat == GameResultEnum::pat) {
                    $result = $this->resultat;
                }

                if ($this->resultat == $player) {
                    $result = GameResultEnum::win;
                }
            }

            $gameplayer          = new GamePlayer();
            $gameplayer->game_id = $newGame->id;
            $gameplayer->user_id = $player;
            $gameplayer->color   = $color;
            $gameplayer->result  = $result;
            $gameplayer->save();
        }
    }

    public function updatedPlayers($value)
    {
        if (count($this->players) > 0){
            foreach ($this->playersColors as $key => $color) {
                if (!in_array($key,$this->players)){
                    unset($this->playersColors[$key]);
                }
            }
        }

    }

    public function rules()
    {
        $arrayRules = [];
        if (count($this->players) > 2) {
            return [
                'selectBlanc' => 'sometimes',
                'playersColors' => 'required|array|size:'. count($this->players),
                'playersColors.*' => 'required|string'
            ];
        }

        if ($this->type === "Terminé"){
            $arrayRules['resultat'] = "required|not_in:none";
        }

        $arrayRules['selectBlanc'] = 'required|not_in:nul';

        return $arrayRules;
    }

    public function submit(CreateNotificationAction $createNotificationAction, SendNotificationAction $sendNotificationAction)
    {
        $this->validate();

        $newGame = new Game();
        $newGame->label = $this->partyName;
        $newGame->created_by = Auth::id();
        $newGame->save();

        $match = match ($this->type) {
            GameStatusEnum::waiting->name => $newGame->status->transitionTo(PlayersValidation::class),
            GameStatusEnum::ended->name => $newGame->status->transitionTo(ResultValidations::class)
         };



        foreach ($this->players as $player) {
            $color = "noir";
            if (count($this->playersColors) > 0 ){
                $color = $this->playersColors[$player];
            }
            if($this->selectBlanc == $player) {
                $color = "blanc";
            }

            $result = null;

            if ($this->type == GameStatusEnum::ended) {
                $result = GameResultEnum::lose;
                if ($this->resultat == GameResultEnum::nul || $this->resultat == GameResultEnum::pat) {
                    $result = $this->resultat;
                }

                if ($this->resultat == $player) {
                    $result = GameResultEnum::win;
                }
            }

            $gameplayer          = new GamePlayer();
            $gameplayer->game_id = $newGame->id;
            $gameplayer->user_id = $player;
            $gameplayer->color   = $color;
            $gameplayer->result  = $result;
            $gameplayer->save();
        }
           if ($this->type == GameStatusEnum::waiting->value){
                session()->flash('message_url', route('game.show',['id' => $newGame->id]));
                session()->flash('message', 'Votre partie a bien été créée. Un email a été envoyé au(x) joueur(s) pour les avertir.');

                $creator = Auth::id();
                $type = 'Création de partie';
                $message = 'Vous avez été invité a rejoindre une partie';


               $notification = $createNotificationAction->execute($creator,$type,$message);

                foreach ($this->players as $player){
                    if((int)$player != Auth::id()) {
                        $sendNotificationAction->execute($notification->id, $player->id);
                    }
                }
                return redirect('dashboard');
           }

        session()->flash('message', 'Votre partie a bien été créée.');
             return redirect('dashboard');
    }

    public function render()
    {
        return view('livewire.game-create');
    }


}
