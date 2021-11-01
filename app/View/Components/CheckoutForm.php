<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CheckoutForm extends Component
{

    public $number;

    public $title;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $number)
    {
        $this->title = $title;
        $this->number = $number;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.checkout-form');
    }
}
