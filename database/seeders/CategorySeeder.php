<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->data()->each(function($category) {
            Category::create($category);
        });
    }

    private function data()
    {
        return collect([
            ['id' => 1, 'name' => 'TV & Video'],
            ['id' => 2, 'name' => 'Audio & Home Theatre'],
            ['id' => 3, 'name' => 'Computer'],
            ['id' => 4, 'name' => 'Laptop'],
            ['id' => 5, 'name' => 'Wearable Technology'],
        ]);
    }
}
