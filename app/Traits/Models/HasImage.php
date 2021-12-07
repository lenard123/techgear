<?php

namespace App\Traits\Models;

use App\Models\Image;

trait HasImage
{
    public function image()
    {
        return $this->belongsTo(Image::class);
    }

    public function getImageUrlAttribute()
    {
        return $this->image->url;
    }
}