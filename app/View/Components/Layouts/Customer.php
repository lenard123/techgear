<?php

namespace App\View\Components\Layouts;

use Illuminate\View\Component;
use App\Models\Category;

class Customer extends Component
{

    public $categories;
    public $title;
    public $jsData;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title = null, $jsData = [])
    {
        $this->categories = Category::all();
        $this->title = $title;
        $this->jsData = $jsData;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('layouts.customer.index');
    }
}
