<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;

class IndexController extends Controller
{
    public function __invoke()
    {

        $data = [
            'featuredProducts' => Product::featured(),
        ];

        return view('customer.index', $data);
    }
}
