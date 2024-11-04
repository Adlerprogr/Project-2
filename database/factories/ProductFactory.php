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
            'category_id' => 1, // Создаем связанную категорию
            'name' => $this->faker->unique()->word, // Уникальное название продукта
            'description' => $this->faker->sentence(15), // Генерируем более длинное описание
            'calories' => $this->faker->numberBetween(50, 500),
            'squirrels' => $this->faker->numberBetween(1, 20),
            'fats' => $this->faker->numberBetween(1, 20),
            'carbohydrates' => $this->faker->numberBetween(1, 50),
            'weight' => $this->faker->numberBetween(100, 1000), // Вес в граммах
            'price' => $this->faker->randomFloat(2, 1, 4000), // Цена от 1 до 4000
            'image_id' => 1,
            'quantity' => 10,
        ];
    }

    // Пример метода для создания продукта с заданной категорией
    public function withCategory(Category $category)
    {
        return $this->state([
            'category_id' => $category->id,
        ]);
    }

    // Пример метода для создания продукта с заданным изображением
    public function withImage($imageId)
    {
        return $this->state([
            'image_id' => $imageId,
        ]);
    }


}
