<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\UserProduct;
use App\Services\CartService;
use App\Services\OrderService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    private CartService $cartService;
    private OrderService $orderService;

    public function __construct(CartService $cartService, OrderService $orderService)
    {
        $this->cartService = $cartService;
        $this->orderService = $orderService;
    }

    public function orderPage()
    {
        // Получаем все товары пользователя по его ID
        $userProducts = UserProduct::where('user_id', Auth::id())
            ->orderBy('id')
            ->get();

        $totals = $this->cartService->totals($userProducts);

        return view('order', compact('userProducts', 'totals'));
    }

    public function addOrder(OrderRequest $request)
    {
        $user = Auth::user();

        try {
            $this->orderService->createOrder($user, $request);
            return redirect('/main');
        } catch (\Exception $e) {
            Log::error('Ошибка при создании заказа: ' . $e->getMessage());

            return redirect()->back()->withErrors(['error' => 'Произошла ошибка при создании заказа.']);
        }
    }
}
