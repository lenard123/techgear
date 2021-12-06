<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Image;
use App\Enums\ImageSource;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->data()->each(function($image) {
            Image::create($image);
        });
    }

    private function data()
    {
        return collect([
            ['id' => 1, 'url' => 'img/default.jpg', 'source' => ImageSource::ASSET],
            ['id' => 2, 'url' => 'img/product2.jpg', 'source' => ImageSource::ASSET],
        ]);
    }
}
