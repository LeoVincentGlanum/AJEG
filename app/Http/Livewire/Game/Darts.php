<?php

namespace App\Http\Livewire\Game;

use App\Actions\CreateNotificationAction;
use App\Actions\SendNotificationAction;
use App\Models\Notification;
use App\Models\User;
use Livewire\Component;
use App\Models\GameType;
use Illuminate\Database\Eloquent\Collection;

class Darts extends Component
{
    public Collection $users;

    public Collection $notifications;
    public ?Collection $gameTypes;
    public ?array $playersId = [];
    public ?string $partyName = "";

    protected $messages = [
        'selectBlanc.not_in' => 'Attention ! Merci de selectionner un joueur blanc',
    ];

    public function mount()
    {
        $this->users = User::all();
        $this->notifications = Notification::all();
        $this->gameTypes = GameType::all();
    }


    public function gotto()
    {
        return redirect("dashboard");
    }

    public function rules()
    {
//        $arrayRules = [];
//        if (count($this->playersId) > 2) {
//            return [
//                'selectBlanc' => 'sometimes',
//                'playersColors' => 'required|array|size:'.count($this->playersId),
//                'playersColors.*' => 'required|string',
//            ];
//        }
//
//        if ($this->type === "Terminé"){
//            $arrayRules['resultat'] = "required|not_in:none";
//        }
//
//        $arrayRules['selectBlanc'] = 'required|not_in:nul';
//
//        return $arrayRules;
    }

    public function submit(CreateNotificationAction $createNotificationAction, SendNotificationAction $sendNotificationAction)
    {

        session()->flash('message', 'Votre partie a bien été créée.');
        return redirect('dashboard');
    }

    public function render()
    {
        return view('livewire.game.darts');
    }

}
