<?php

namespace App\Http\Controllers;

use App\Models\UserProduct;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    private CartService $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function cartPage()
    {
        // Получите все товары пользователя по его ID
        $userProducts = UserProduct::where('user_id', Auth::id())
            ->orderBy('id')
            ->get();

        if ($userProducts) {
            // Инициализация переменной для суммирования
            $totalQuantity = 0;
            $totalPrice = 0;

            // Итерация по продуктам пользователя
            foreach ($userProducts as $userProduct) {
                // Добавление количества каждого продукта к общей сумме
                $totalQuantity  += $userProduct->quantity;
                $totalPrice     += $userProduct->quantity * $userProduct->product->price;
            }

            $deliveryAmount = 0;

            if ($totalPrice < 1000) {
                $deliveryAmount = 200;
            } elseif ($totalPrice >= 1000 && $totalPrice < 2000) {
                $deliveryAmount = 150;
            } elseif ($totalPrice >= 2000) {
                $deliveryAmount = 0;
            }

            $totalToBePaid = $deliveryAmount + $totalPrice;
        } else {
            // Обработка ситуации, когда корзина пуста
            $totalQuantity = 0;
            $totalPrice = 0;
            $deliveryAmount = 0;
            $totalToBePaid = 0;
        }

        return view('cart', compact('userProducts', 'totalQuantity', 'totalPrice', 'deliveryAmount', 'totalToBePaid'));
    }

    public function add(Request $request)
    {
        $userId = Auth::id();
        $productId = $request->input('product_id');

        $this->cartService->addProduct($userId, $productId);

        return redirect()->back();
    }

    public function remove(Request $request)
    {
        $userId = Auth::id();
        $productId = $request->input('product_id');

        $this->cartService->removeProduct($userId, $productId);

        return redirect()->back();
    }
}
