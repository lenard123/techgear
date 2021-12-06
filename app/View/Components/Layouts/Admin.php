<?php

namespace App\View\Components\Layouts;

use Illuminate\View\Component;

class Admin extends Component
{

    public $user;
    public $title;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title = null)
    {
        $this->title = $this->formatTitle($title);
        $this->user = auth()->user();
    }

    private function formatTitle($title)
    {
        $appName = config('app.name');

        if (is_null($title)) 
            return $appName . ' Admin';

        return "{$title} | {$appName} Admin";
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('layouts.admin.index');
    }
}
