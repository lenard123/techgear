<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;

class ProductController extends Controller
{
    public function show(Product $product)
    {
        return view('customer.products.show', [
            'product' => $product
        ]);
    }
}
