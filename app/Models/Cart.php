<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'quantity'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function calculateSubtotal()
    {
        return $this->quantity * $this->product->price;
    }

    public function canIncrement()
    {
        return $this->quantity+1 <= $this->product->quantity;
    }

    public static function getUserCarts($user_id)
    {
        return Cart::with('product.image', 'product.category')
            ->where('user_id', $user_id)
            ->get();
    }

    public static function clearUserCarts($user_id)
    {
        Cart::where('user_id', $user_id)
            ->delete();
    }
}
