<?php

namespace App\View\Components\ProductCard;

use Illuminate\View\Component;

class Container extends Component
{

    public $products;
    public $title;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($products, $title = 'Products')
    {
        $this->products = $products;
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.product-card.container');
    }
}
