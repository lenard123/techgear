<?php

namespace App\View\Components\SimpleInput;

use Illuminate\View\Component;

class Text extends Component
{

    public $label;
    public $name;
    public $type;
    public $placeholder;
    public $required;
    public $inputClass;
    public $value;
    public $disabled;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($label, $name, $type = 'text', $placeholder = null, $required = false, $inputClass = '', $value = null, $disabled = false)
    {
        $this->label = $label;
        $this->name = $name;
        $this->type = $type;
        $this->placeholder = $placeholder;
        $this->required = $required;
        $this->inputClass = $inputClass;
        $this->value = $value;
        $this->disabled = $disabled;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.simple-input.text');
    }
}
