<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        return [
            'category_id' => Category::factory(),
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
            'calories' => $this->faker->numberBetween(50, 500),
            'squirrels' => $this->faker->numberBetween(1, 20),
            'fats' => $this->faker->numberBetween(1, 20),
            'carbohydrates' => $this->faker->numberBetween(1, 50),
            'weight' => $this->faker->numberBetween(100, 1000), // Вес в граммах
            'price' => $this->faker->randomFloat(2, 1, 100), // Цена от 1 до 100
//            'image_id' => $this->faker->numberBetween(1, 10), // Предполагаем, что изображения уже созданы с ID от 1 до 10
            'quantity' => $this->faker->numberBetween(1, 100), // Количество
        ];
    }
}
