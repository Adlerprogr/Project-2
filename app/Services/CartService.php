<?php

namespace App\Services;

use App\Models\UserProduct;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;

class CartService
{
    public function addProduct(int $userId, int $productId): void
    {
        try {
            $productExists = UserProduct::where('user_id', $userId)
                ->where('product_id', $productId)
                ->first();

            if ($productExists) {
                $productExists->increment('quantity');
            } else {
                UserProduct::create([
                    'user_id' => $userId,
                    'product_id' => $productId,
                    'quantity' => 1,
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Ошибка при добавлении продукта в корзину: ' . $e->getMessage());
        }
    }

    public function removeProduct(int $userId, int $productId): void
    {
        try {
            $productExists = UserProduct::where('user_id', $userId)
                ->where('product_id', $productId)
                ->first();

            if ($productExists) {
                $productExists->quantity > 1 ? $productExists->decrement('quantity') : $productExists->delete();
            }
        } catch (\Exception $e) {
            Log::error('Ошибка при удалении продукта из корзины: ' . $e->getMessage());
        }
    }

    public function clearUserProducts(int $userId): void
    {
        try {
            UserProduct::where('user_id', $userId)->delete();
        } catch (\Exception $e) {
            Log::error('Ошибка при очистке корзины пользователя: ' . $e->getMessage());
        }
    }

    public function totals(Collection $userProducts): array
    {
        $totalPrice = $userProducts->sum(function ($userProduct) {
            return $userProduct->quantity * $userProduct->product->price;
        });

        $totalQuantity = $userProducts->sum('quantity');

        // Определяем стоимость доставки
        $deliveryAmount = match (true) {
            $totalPrice < 1000 => 200,
            $totalPrice < 2000 => 150,
            default => 0,
        };

        return [
            'totalQuantity' => $totalQuantity,
            'totalPrice' => $totalPrice,
            'deliveryAmount' => $deliveryAmount,
            'totalToBePaid' => $totalPrice + $deliveryAmount,
        ];
    }
}
