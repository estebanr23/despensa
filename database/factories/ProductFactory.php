<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;

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
    public function definition()
    {
        return [
            'codigo' => $this->faker->regexify('[A-Z]{5}[0-4]{3}'),
            'nombre_prod' => $this->faker->word(),
            'precio_prod' => $this->faker->randomFloat(2, 20, 500),
            'stock_prod' => $this->faker->randomNumber(3, true),
            'stock_prod_min' => $this->faker->randomNumber(2, true),
            'category_id' => $this->faker->randomElement([1, 2, 3, 4, 5])
        ];
    }
}
