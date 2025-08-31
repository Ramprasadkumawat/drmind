<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProductImage;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ProductImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        ProductImage::truncate();
        $faker = Faker::create();

        $products = Product::all();

        if ($products->isEmpty()) {
            // If no products, run ProductSeeder first
            $this->call(ProductSeeder::class);
            $products = Product::all();
        }

        foreach ($products as $product) {
            for ($i = 0; $i < rand(1, 3); $i++) { // Add 1 to 3 images per product
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => 'product_images/product-image-' . rand(1, 10) . '.jpg',
                    'image_name' => $faker->word() . '.jpg',
                ]);
            }
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
