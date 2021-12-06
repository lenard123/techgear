<?php

namespace App\View\Components\Layouts;

use Illuminate\View\Component;

class Main extends Component
{
    public $title;

    public function __construct($title = null)
    {
        $this->title = $title;
    }

    public function render()
    {
        return view('layouts.main');
    }
}