<?php

namespace App\Services;

use App\Models\UserProduct;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\Cast\Object_;

class CartService
{
    public function addProduct(int $userId, int $productId)
    {
        // Проверка, есть ли уже этот продукт в корзине пользователя
        $productExists = UserProduct::where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();

        if ($productExists) {
            // Если продукт уже в корзине, увеличиваем количество
            $productExists->increment('quantity');
        } else {
            // Если продукта нет в корзине, создаем новую запись
            UserProduct::create([
                'user_id' => $userId, // ID текущего пользователя
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
                $productExists->decrement('quantity');
            } else {
                // Если количество равно 1, удаляем запись
                $productExists->delete();
            }
        }
    }

    public function totals(Object $userProducts)
    {
        // Инициализация переменных
        $totalQuantity = 0;
        $totalPrice = 0;
        $deliveryAmount = 0;

        if ($userProducts) {
            // Итерация по продуктам пользователя
            foreach ($userProducts as $userProduct) {
                // Добавление количества каждого продукта к общей сумме
                $totalQuantity += $userProduct->quantity;
                $totalPrice += $userProduct->quantity * $userProduct->product->price;
            }
        }

        // Определяем стоимость доставки
        if ($totalPrice < 1000) {
            $deliveryAmount = 200;
        } elseif ($totalPrice >= 1000 && $totalPrice < 2000) {
            $deliveryAmount = 150;
        } elseif ($totalPrice >= 2000) {
            $deliveryAmount = 0;
        }

        // Подсчитываем общую сумму к оплате
        $totalToBePaid = $totalPrice + $deliveryAmount;

        return [
            'totalQuantity' => $totalQuantity,
            'totalPrice' => $totalPrice,
            'deliveryAmount' => $deliveryAmount,
            'totalToBePaid' => $totalToBePaid
        ];
    }
}
