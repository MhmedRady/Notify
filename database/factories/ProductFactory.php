<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{

    protected $model = Product::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => "product {$this->faker->numberBetween(1,50)}",
            'price' => $this->faker->numberBetween(100,1000),
            'seller_id'=> 2,
            'stock' => $this->faker->numberBetween(1, 10),
            'weight' => $this->faker->numberBetween(0, 5),
        ];
    }
}
