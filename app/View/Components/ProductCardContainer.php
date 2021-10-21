<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Database\Eloquent\Collection;

class ProductCardContainer extends Component
{

    public $products;

    /**
     * Create a new component instance.
     *
     * @param App\Models\Product[] $products
     * 
     * @return void
     */
    public function __construct(Collection $products)
    {
        $this->products = $products;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.product-card-container');
    }
}
