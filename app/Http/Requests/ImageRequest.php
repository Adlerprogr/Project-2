<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImageRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'weight' => 'required|numeric',
            'calories' => 'required|numeric',
            'squirrels' => 'required|numeric',
            'fats' => 'required|numeric',
            'carbohydrates' => 'required|numeric',
            'price' => 'required|numeric',
            'image' => 'required|file|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'nullable|exists:category,id',
            'quantity' => 'nullable|numeric',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
