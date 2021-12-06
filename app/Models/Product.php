<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\ImageSource;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

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
            ->where('is_featured', true)
            ->get();
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function image()
    {
        return $this->belongsTo(Image::class);
    }

    public function imageUrl()
    {
        switch ($this->image->source) {

            case ImageSource::ASSET:
                return asset($this->image->url);

            case ImageSource::STORAGE:
                return storage($this->image->url);

            default:
                return $this->image->url;
        }
    }
}
