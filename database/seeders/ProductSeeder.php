<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Create 10 product with category 
        for ($i = 0; $i < 5; $i++) {
            
            // category create
            $subcategory = Subcategory::create([
                'name' => $faker->word
            ]);

            // Create products for each subcategory
            for ($j = 0; $j < 5; $j++) {
                Product::create([
                    'subcategory_id' => $subcategory->id,
                    'product_type' => $faker->randomElement(['auction', 'feature']),
                    'condition' => $faker->randomElement(['any', 'new', 'used']),
                    'seller_type' => $faker->randomElement(['verified', 'unverified']),
                    'location' => $faker->randomElement(['Islamabad', 'Peshawar', 'Mardan']),
                    'radius' => $faker->numberBetween(1, 100),
                    'price' => $faker->randomFloat(2, 100, 10000)
                ]);
            }
        }
    }
}
