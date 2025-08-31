<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Product::truncate();
        $faker = Faker::create();

        $categories = Category::where('parent_id', 0)->get(); // Main categories
        $subcategories = Category::where('parent_id', '!=', 0)->get(); // Subcategories

        if ($categories->isEmpty()) {
            // If no categories, then run CategorySeeder first
            $this->call(CategorySeeder::class);
            $categories = Category::where('parent_id', 0)->get();
            $subcategories = Category::where('parent_id', '!=', 0)->get();
        }

        foreach ($categories as $category) {
            for ($i = 0; $i < 5; $i++) { // Create 5 products per main category
                $productName = $faker->sentence(3);
                $product = Product::create([
                    'product_name' => $productName,
                    'slug' => Str::slug($productName . '-' . Str::random(5)),
                    'manufacturar_name' => $faker->company(),
                    'product_identification_no' => $faker->isbn10(),
                    'product_sku' => Str::random(8),
                    'images' => json_encode([
                        'products/product-' . rand(1, 5) . '.jpg',
                        'products/product-' . rand(6, 10) . '.jpg',
                    ]),
                    'description' => $faker->paragraph(5),
                    'short_description' => $faker->paragraph(2),
                    'product_status' => $faker->randomElement(['draft', 'publish']),
                    'publish_date' => $faker->date(),
                    'product_stock' => $faker->numberBetween(10, 200),
                    'earning_point' => $faker->numberBetween(10, 100),
                    'product_category' => $category->id,
                    'product_subcategory' => $subcategories->random()->id ?? null,
                    'tags' => json_encode([$faker->word(), $faker->word()]),
                    'specification_terms' => json_encode([$faker->sentence(2), $faker->sentence(2)]),
                    'base_price' => $faker->randomFloat(2, 10, 500),
                    'price_currency' => 'usd',
                    'product_discount_type' => $faker->randomElement(['none', 'fixed', 'percentage']),
                    'discount_value' => $faker->randomFloat(2, 5, 50),
                    'product_price' => $faker->randomFloat(2, 5, 450),
                    'product_shipping' => $faker->randomElement(['vendor', 'drmind']),
                    'stock_status' => $faker->randomElement(['instock', 'unavailable', 'to_be_announced']),
                ]);
            }
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
