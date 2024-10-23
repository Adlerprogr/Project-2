<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class CurrencyService
{
    public function getExchangeRate(string $currency = 'USD'): ?float
    {
        $response = Http::get('https://api.exchangerate-api.com/v4/latest/RUB');
        $data = $response->json();

        return $data['rates'][$currency] ?? null;
    }

    public function convertPrice(float $price, float $exchangeRate): float
    {
        return $price * $exchangeRate;
    }
}
