<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Enums\OrderStatus;

class ReportController extends Controller
{
    public function salesReport()
    {

        $products = Product::withSum([
                'order_items as sales' => function($query) {
                    $query
                        ->join('orders', 'orders.id', 'order_items.order_id')
                        ->where('orders.status', OrderStatus::DELIVERED);
                }
            ], 'quantity')
            ->orderBy('sales', 'DESC')
            ->get();

        return view('admin.reports.sales', [
            'products' => $products
        ]);
    }

    public function stocksReport()
    {
        $products = Product::orderBy('quantity', 'DESC')->orderBy('favorites_count', 'DESC')->get();

        return view('admin.reports.stocks', [
            'products' => $products
        ]);
    }

    public function favoritesReport()
    {
        $products = Product::withCount('favorites')->get();

        return view('admin.reports.favorites', [
            'products' => $products
        ]);
    }
}
