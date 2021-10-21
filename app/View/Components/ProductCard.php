<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Product;

class ProductCard extends Component
{

    public Product $product;

    /**
     * Create a new component instance.
     *
     * @param App\Models\Product $product 
     * @return void
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.product-card');
    }
}
