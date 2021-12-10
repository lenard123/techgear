<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;

class HomeController extends Controller
{
    public function __invoke()
    {

        $categories = Category::whereRelation('products', 'is_published', true)->get();

        return view('customer.home.index', [
            'slides' => config('site.carousel_images'),
            'featuredProducts' => Product::featured(),
            'categories' => $categories,
        ]);
    }
}
