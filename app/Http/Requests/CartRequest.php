<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CartRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Разрешаем выполнять запросы авторизованным пользователям
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'product_id' => 'required|integer|exists:products,id', // Проверка на существующий идентификатор продукта
        ];
    }

    public function messages(): array
    {
        return [
            'product_id' => $this->productIdMessages(),
        ];
    }

    protected function productIdMessages(): array
    {
        return [
            'required' => 'Требуется выбрать продукт.',
            'integer' => 'Идентификатор продукта должен быть целым числом.',
            'exists' => 'Продукт не найден.',
        ];
    }
}
