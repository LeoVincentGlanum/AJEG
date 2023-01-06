<?php

namespace App\Http\Livewire\Interface;

use App\Http\Livewire\Traits\HasToast;
use App\Models\Game;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

class InteractableAdvises extends Component
{
    public string $mainText;
    public string $buttonText;
    public string $state;
    public string $eventName;
    public bool $visible = false;
    public Model $model;

    public function mount(
        string $mainText,
        string $buttonText,
        string $eventName,
        Model $model,
    ) {
        $this->mainText = $mainText;

        $this->state = $model->status->name();
        $this->model = $model;

        if(isset($buttonText))
        {
            $this->buttonText = $buttonText;
            $this->eventName = $eventName;
        }
    }

    public function sync()
    {
        if(!$this->visible) {

            $model = clone $this->model;

            $model->refresh();
            $newStatus = $model->status->name();

            if($newStatus !== $this->state)
            {
                $this->visible = true;
                $this->state = $newStatus;
            }
        }
    }

    public function refreshParent()
    {
        $this->emit($this->eventName);
        $this->visible = false;
    }

    public function render()
    {
        return view('livewire.interface.interactable-advises');
    }
}
