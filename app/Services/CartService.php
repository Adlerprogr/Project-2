<?php

namespace App\Services;

use App\Models\UserProduct;
use Illuminate\Support\Facades\Auth;

class CartService
{
    public function addProduct(int $userId, int $productId)
    {
        // Проверка, есть ли уже этот продукт в корзине пользователя
        $productExists = UserProduct::where('user_id', $userId) // userId
            ->where('product_id', $productId)
            ->first();

        if ($productExists) {
            // Если продукт уже в корзине, увеличиваем количество
            $productExists->quantity += 1;
            $productExists->save();
        } else {
            // Если продукта нет в корзине, создаем новую запись
            UserProduct::create([
                'user_id' => Auth::id(), // ID текущего пользователя
                'product_id' => $productId,
                'quantity' => 1,
            ]);
        }
    }

    public function removeProduct(int $userId, int $productId)
    {
        // Проверка, есть ли уже этот продукт в корзине пользователя
        $productExists = UserProduct::where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();

        if ($productExists) {
            if ($productExists->quantity > 1) {
                // Если количество больше 1, уменьшаем на 1
                $productExists->quantity -= 1;
                $productExists->save();
            } else {
                // Если количество равно 1, удаляем запись
                $productExists->delete();
            }
        }
    }
}
