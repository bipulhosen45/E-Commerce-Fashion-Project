<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_id' => random_int(9, 17),
            'subcategory_id' => random_int(13, 21),
            'childcategory_id' => random_int(22, 32),
            'brand_id' => random_int(31, 61),
            'pickup_point_id' => random_int(10, 11),
            'name' => $this->faker->words(),
            'slug' => $this->faker->slug(),
            'code' => $this->faker->randomDigit(0, 9),
            'color' => $this->faker->safeColorName(),
            'size' => random_int(32, 42),
            'purchase_price' => random_int(1000, 2000),
            'selling_price' => random_int(2500, 4000),
            'discount_price' => random_int(300, 500),
            'stock_quantity' => random_int(250, 500),
            'warehouse' => random_int(2, 3),
            'description' => $this->faker->paragraph(),
            'thumbnail' => $this->faker()->image('public/backend/files/product', 600, 600, 'animals', true, true, 'cats', true, 'jpg'),
            'images' => $this->faker()->image('public/backend/files/product', 600, 600, 'animals', true, true, 'cats', true, 'jpg'),
            'featured' => 1,
            'today_deal' => 1,
            'product_slider' => 1,
            'trendy' => 1,
            'status' => 1,
            'admin_id' => random_int(2, 8),
            
        ];
    }
}
