<?php

namespace App\Services;

use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use App\Enums\ImageSource;

class ImageUploadService
{

    public static function upload($name)
    {
        $request = request();

        if (! $request->file($name) ) return Image::DEFAULT;

        if (config('filesystems.default') === 'cloudinary') {

            $file = $request->file($name)->storeOnCloudinary('techgear');
            $url = $file->getSecurePath();
            $source = ImageSource::URL;

            return static::getImageId($url, $source);

        } else {

            $url = $request->file($name)->store('techgear');
            $source = ImageSource::STORAGE;

            return static::getImageId($url, $source); 
        }
    }

    private static function getImageId($url, $source)
    {
        $image = Image::create([
            'url' => $url,
            'source' => $source,
        ]);

        return $image->id;
    }

}