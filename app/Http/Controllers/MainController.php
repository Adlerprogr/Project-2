<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\UserProduct;
use App\Services\CartService;
use App\Services\CurrencyService;
use Illuminate\Support\Facades\Auth;


class MainController extends Controller
{
    private CartService $cartService;
    private CurrencyService $currencyService;

    public function __construct(CartService $cartService, CurrencyService $currencyService)
    {
        $this->cartService = $cartService;
        $this->currencyService = $currencyService;
    }

    public function mainPage(bool $showInUSD = false)
    {
        $products = Product::all();

        $userProducts = UserProduct::where('user_id', Auth::id())
            ->orderBy('id')
            ->get();

        $totals = $this->cartService->totals($userProducts);

        $exchangeRate = null;

        // Конвертация цен в USD, если необходимо
        if ($showInUSD) {
            $exchangeRate = $this->currencyService->getExchangeRate();

            if ($exchangeRate) {
                $products = $products->map(function ($product) use ($exchangeRate) {
                    $product->price_usd = $this->currencyService->convertPrice($product->price, $exchangeRate);
                    return $product;
                });
            }
        }

        return view('main', compact('products', 'totals', 'showInUSD', 'exchangeRate'));
    }

    public function convertPrices()
    {
        return redirect()->route('main', ['showInUSD' => true]);
    }

    public function showInRubles()
    {
        return redirect()->route('main', ['showInUSD' => false]);
    }
}
