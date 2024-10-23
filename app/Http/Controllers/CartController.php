<?php

namespace App\Http\Controllers;

use App\Models\UserProduct;
use App\Services\CartService;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CartRequest;

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

        $totals = $this->cartService->totals($userProducts);

        return view('cart', compact('userProducts', 'totals'));
    }

    public function add(CartRequest $request)
    {
        $userId = Auth::id();
        $productId = $request->input('product_id');

        $this->cartService->addProduct($userId, $productId);

        return redirect()->back();
    }

    public function remove(CartRequest $request)
    {
        $userId = Auth::id();
        $productId = $request->input('product_id');

        $this->cartService->removeProduct($userId, $productId);

        return redirect()->back();
    }
}
