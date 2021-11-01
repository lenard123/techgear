<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SimpleInput extends Component
{

    public $label;
    public $name;
    public $type;
    public $placeholder;
    public $isRequired;
    public $inputClass;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($label, $name, $type = 'text', $placeholder = null, $isRequired = false, $inputClass = '')
    {
        $this->label = $label;
        $this->name = $name;
        $this->type = $type;
        $this->placeholder = $placeholder;
        $this->isRequired = $isRequired;
        $this->inputClass = $inputClass;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.simple-input');
    }
}
