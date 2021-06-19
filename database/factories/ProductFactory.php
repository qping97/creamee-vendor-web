<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            // 'product_img' => $this->faker->image('public/storage/product',640,480, null, false),
            'product_img' => 0,
            'product_price' => '5.00',
            'description' => $this->faker->text,
            'product_category_id' => "1",
            'vendor_id' => "1",
        ];
    }
}