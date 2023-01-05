<?php

namespace App\Http\Livewire\Interface;

use App\Http\Livewire\Traits\HasToast;
use App\Models\Game;
use Livewire\Component;

class InteractableAdvises extends Component
{

    use HasToast;

    public string $mainText;
    public string $buttonText;
    public string $componentName;
    public string $state;
    public string $eventName;
    public bool $visible = false;
    public Game $game;
    public $lastCall = null;
    public string $getValue;
    public $listeners =['setVisibleAdvise','setState'];
    public bool $setStateDone = true;

    public function mount(string $mainText,string $buttonText ,string $componentName , string $eventName , string $state,Game $game,string $getValue)
    {
        dump('mount');
        $this->mainText = $mainText;
        $this->state = $state;
        $this->game            = $game;
        $this->getValue = $getValue;

        if(isset($buttonText))
        {
            $this->buttonText = $buttonText;
            $this->componentName = $componentName;
            $this->eventName = $eventName;
        }
    }

    public function pollEvent()
    {
        if(!$this->visible)
        {
            $isMethode = false;
            if (str_contains($this->getValue, '()')) {
                $methode = str_replace("()", "", $this->getValue);
                $isMethode = true;
            }
            $orderCall = explode("->", $methode);
            $count = count($orderCall);
            $lastCall = null;
            for($i = 0 ;$i<$count ; $i++)
            {
                if($i === 0)
                {
                    $lastCall = $this->{$orderCall[$i]};
                }
                elseif ($isMethode && $i === $count-1)
                {
                    $lastCall = $lastCall->{$orderCall[$i]}();
                }
                else
                {
                    $lastCall = $lastCall->{$orderCall[$i]};
                }
            }
            $this->lastCall =$lastCall;
    //        dump($lastCall .' !== '.$this->state);
            if($this->lastCall !== $this->state)
            {
                $this->visible = true;
            }
        }
    }
    public function setState($state)
    {
        $this->state = $state;
        $this->successToast($state);
        $setStateDone = true;
    }
    public function setFalseVisibleAdvise()
    {
        $this->emitTo($this->componentName, $this->eventName);
        $this->visible = false;

    }

    public function render()
    {
        return view('livewire.interface.interactable-advises');
    }
}
