<?php

namespace App\View\Components\Layouts;

use Illuminate\View\Component;
use App\Models\Category;

class Customer extends Component
{

    public $categories;
    public $cartCount;
    public $title;
    public $jsData;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title = null, $jsData = [])
    {
        $this->categories = Category::published();
        $this->title = $this->formatTitle($title);
        $this->jsData = $jsData;
        $this->cartCount = auth()->user()?->carts()->count() ?? 0;
    }

    private function formatTitle($title)
    {
        $appName = config('app.name');

        if (is_null($title)) 
            return $appName;

        return "{$title} | {$appName}";
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
