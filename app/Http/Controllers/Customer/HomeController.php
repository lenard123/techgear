<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller
{
    public function __invoke()
    {
        return view('customer.home.index')
            ->with('slides', config('site.carousel_images'))
            ->with('featuredProducts', Product::featured())
            ->with('categories', Category::all());
    }
}
