<?php

namespace App\Services;

use App\Models\OrderProduct;
use App\Models\UserProduct;

class OrderProductService
{
    public function createOrderProducts(int $orderId, int $userId)
    {
        $userProducts = UserProduct::where('user_id', $userId)->get();

        // Проверяем, есть ли у пользователя продукты
        if ($userProducts->isEmpty()) {
            throw new \Exception('У пользователя нет продуктов для создания заказа.');
        }

        foreach ($userProducts as $userProduct) {
            OrderProduct::create([
                'product_id' => $userProduct->product_id,
                'order_id' => $orderId,
                'quantity' => $userProduct->quantity,
                'price' => 200, // можно заменить на реальную цену, если она хранится в базе
            ]);
        }
    }
}
