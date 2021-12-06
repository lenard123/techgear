<?php

namespace App\View\Components\Input;

use Illuminate\View\Component;

class Text extends Component
{

    public $class;
    public $labelClass;
    public $inputClass;
    public $errorClass;
    public $label;
    public $name;
    public $value;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $name, 
        $label, 
        $value = null, 
        $inputClass = null, 
        $labelClass = null, 
        $errorClass = null,
        $class = null
    )
    {
        $this->name = $name;
        $this->label = $label;
        $this->value = $value;
        $this->labelClass = $labelClass;
        $this->inputClass = $inputClass;
        $this->class = $class;
        $this->errorClass = $errorClass;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.input.text');
    }
}
