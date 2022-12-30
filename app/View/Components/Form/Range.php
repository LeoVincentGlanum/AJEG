<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class Range extends Component
{
    public string $nameMin;

    public string $nameMax;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($nameMin, $nameMax)
    {
        $this->nameMin = $nameMin;
        $this->nameMax = $nameMax;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.range');
    }
}
