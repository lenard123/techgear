<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Category;

class CustomerLayout extends Component
{

    public $categories;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->categories = Category::all();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.customer-layout');
    }
}
