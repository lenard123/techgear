<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\ImageSource;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Models\HasImage;

class Product extends Model
{
    use SoftDeletes, HasImage;

    protected $fillable = [
        'name',
        'category_id',
        'description',
        'price',
        'quantity',
        'is_published',
        'is_featured'
    ];

    public static function featured()
    {
        return Product::with('category', 'image')
            ->where('is_published', true)
            ->where('is_featured', true)
            ->get();
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function order_items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }
}
