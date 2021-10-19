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
        $data = collect([
            ['name' => 'TV & Video'],
            ['name' => 'Audio & Home Theatre'],
            ['name' => 'Computer'],
            ['name' => 'Laptop'],
            ['name' => 'Wearable Technology'],
        ]);

        $data->each(fn($category) => Category::create($category));
    }
}
