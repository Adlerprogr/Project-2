<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CartRequest extends FormRequest
{
    public function authorize()
    {
        // Разрешаем выполнять запросы авторизованным пользователям
        return auth()->check();
    }

    public function rules()
    {
        return [
            'product_id' => 'required|integer|exists:products,id', // Проверка на существующий идентификатор продукта
        ];
    }

    public function messages()
    {
        return [
            'product_id.required' => 'Требуется выбрать продукт.',
            'product_id.integer' => 'Идентификатор продукта должен быть целым числом.',
            'product_id.exists' => 'Продукт не найден.',
        ];
    }
}
