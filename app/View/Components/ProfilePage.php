<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ProfilePage extends Component
{

    public $title;
    public $active;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title = null, $active = null)
    {
        $this->title = $title;
        $this->active = $active;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('layouts.customer.profile-page');
    }
}
