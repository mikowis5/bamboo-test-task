<?php

namespace Database\Seeders;

use App\Modules\Accounts\Models\User;
use App\Modules\Products\Models\Category;
use App\Modules\Products\Models\Product;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        foreach (range(1, 3) as $i) {
            $category = Category::factory()->create();

            $products = Product::factory()->category($category)->count(10)->create();
        }
    }
}
