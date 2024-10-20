<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\UserProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;


class MainController extends Controller
{
    public function mainPage($showInUSD = false)
    {
        $userId = Auth::id();
        $products = Product::all();

        $totalQuantity = 0;
        if ($userId) {
            $userProducts = UserProduct::where('user_id', $userId)->first();

            if ($userProducts) {
                $totalQuantity = UserProduct::where('user_id', $userId)->sum('quantity');
            }
        }

        $exchangeRate = null; // Инициализируем переменную

        // Если необходимо показывать в долларах
        if ($showInUSD) {
            $exchangeRate = $this->getExchangeRate();
            if ($exchangeRate) {
                $products = $products->map(function ($product) use ($exchangeRate) {
                    $product->price_usd = $product->price * $exchangeRate; // Конвертация
                    return $product;
                });
            }
        }

        return view('main', compact('products', 'totalQuantity', 'showInUSD', 'exchangeRate'));
    }

    public function getExchangeRate()
    {
        $response = Http::get('https://api.exchangerate-api.com/v4/latest/RUB'); // URL для получения курса
        $data = $response->json();

        return $data['rates']['USD'] ?? null; // Возвращает курс доллара
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
