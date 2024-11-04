<?php

namespace App\DTO;

use App\Http\Requests\ImageRequest;

class ProductDTO
{
    public int $category_id;
    public string $name;
    public string $description;
    public int $calories;
    public int $squirrels;
    public int $fats;
    public int $carbohydrates;
    public int $weight;
    public float $price;
    public int|null $image_id = null;
    public int|null $quantity = null;
    public $image;

    public function __construct(ImageRequest $imageRequest)
    {
        $this->category_id = $imageRequest->input('category_id');
        $this->name = $imageRequest->input('name');
        $this->description = $imageRequest->input('description');
        $this->calories = $imageRequest->input('calories');
        $this->squirrels = $imageRequest->input('squirrels');
        $this->fats = $imageRequest->input('fats');
        $this->carbohydrates = $imageRequest->input('carbohydrates');
        $this->weight = $imageRequest->input('weight');
        $this->price = $imageRequest->input('price');
        $this->quantity = $imageRequest->input('quantity');
        $this->image = $imageRequest->file('image');
    }

    public function toArray(): array
    {
        return [
            'category_id' => $this->category_id,
            'name' => $this->name,
            'description' => $this->description,
            'calories' => $this->calories,
            'squirrels' => $this->squirrels,
            'fats' => $this->fats,
            'carbohydrates' => $this->carbohydrates,
            'weight' => $this->weight,
            'price' => $this->price,
            'image_id' => $this->image_id,
            'quantity' => $this->quantity,
        ];
    }
}
