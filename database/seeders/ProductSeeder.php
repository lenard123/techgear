<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->data()->each(function($product) {
            Product::create($product);
        });
    }

    private function data()
    {
        return collect([
            [
                'id' => 1,
                'category_id' => 4,
                'image_id' => 1,
                'name' => 'Apple MacBook Pro 15" Touch Bar MPTU2LL/A 256GB (Silver)',
                'description' => 'No description Available',
                'price' => 25999.50,
                'quantity' => 10,
                'is_featured' => true,
                'is_published' => true,
            ]
        ]);
    }
}
