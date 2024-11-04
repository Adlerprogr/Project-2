<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CurrencyService
{
    private const BASE_CURRENCY = 'RUB';
    private const EXCHANGE_RATE_API_URL = 'https://api.exchangerate-api.com/v4/latest/' . self::BASE_CURRENCY;

    public function getExchangeRate(string $currency = 'USD'): ?float
    {
        // Валидация входных данных
        if (empty($currency) || !preg_match('/^[A-Z]{3}$/', $currency)) {
            Log::warning('Некорректный код валюты: ' . $currency);
            return null;
        }

        try {
            // Установка тайм-аута и отправка запроса
            $response = Http::timeout(5)->get(self::EXCHANGE_RATE_API_URL);

            // Проверка на успешный ответ
            if ($response->failed()) {
                Log::error('Ошибка при получении курсов валют: ' . $response->body());
                return null;
            }

            $data = $response->json();

            // Проверка наличия данных о валюте
            return $data['rates'][$currency] ?? null;

        } catch (\Exception $e) {
            Log::error('Исключение при получении курсов валют: ' . $e->getMessage());
            return null;
        }
    }

    public function convertPrice(float $price, float $exchangeRate): float
    {
        return $price * $exchangeRate;
    }
}
