<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Enums\OrderStatus;
use Illuminate\Support\Facades\DB;

class Category extends Model
{

    use SoftDeletes;

    protected $fillable = ['name'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public static function getStocksReport()
    {
        $stocks = self::withSum('products as stocks', 'quantity')->get();
        return $stocks;
    }

    public static function getSalesReport()
    {
        $sales = self::select([
                'categories.*',
                DB::raw('sum(order_items.price * order_items.quantity) as sales')
            ])
            ->leftJoin('products', 'categories.id', 'products.category_id')
            ->leftJoin('order_items', function($join) {
                $join->on('products.id', 'order_items.product_id')
                     ->join('orders', function($join) {
                        $join->on('orders.id', 'order_items.order_id')
                             ->where('orders.status', OrderStatus::DELIVERED);
                     });
            })
            ->groupBy('categories.id')
            ->get();
        return $sales;
    }
}
