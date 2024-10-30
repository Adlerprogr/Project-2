<?php

namespace App\Services;

use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\User;
use App\Models\UserProduct;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Jobs\SendEmailJob;

class OrderService
{
    private BitrixService $bitrixService;

    public function __construct(BitrixService $bitrixService)
    {
        $this->bitrixService = $bitrixService;
    }
 // dto я передачи данных
    public function createOrder(User|null $user, OrderRequest $request)
    {
        $userId = $user->id;

        try {
            DB::transaction(function () use ($request, $userId, &$order) {
                $order = Order::create(array_merge($request->all(), ['user_id' => $userId]));
                $this->createOrderProducts($order->id, $userId);
                $this->clearUserProducts($userId);
            });

            // Создание лида в Bitrix
            $this->createLead($request, $order);

            // Отправка Email
            $this->sendOrderEmail($user, $order);
        } catch (\Exception $e) {
            Log::error('Ошибка при создании заказа: ' . $e->getMessage(), [
                'user_id' => $userId,
                'request_data' => $request->all(),
            ]);

            throw $e; // Бросаем исключение для обработки в контроллере
        }
    }

    private function createOrderProducts(int $orderId, int $userId)
    {
        $userProducts = UserProduct::where('user_id', $userId)->get();

        foreach ($userProducts as $userProduct) {
            OrderProduct::create([
                'product_id' => $userProduct->product_id,
                'order_id' => $orderId,
                'quantity' => $userProduct->quantity,
                'price' => 200,
            ]);
        }
    }

    private function clearUserProducts(int $userId)
    {
        UserProduct::where('user_id', $userId)->delete();
    }

    private function createLead(OrderRequest $request, Order $order)
    {
        $leadData = [
            'TITLE' => 'Заказ #' . $order->id,
            'LAST_NAME' => $order->last_name ?? 'Имя не указано',
            'EMAIL' => [
                [
                    'VALUE' => $order->email,
                    'VALUE_TYPE' => 'WORK'
                ]
            ],
            'PHONE' => [
                [
                    'VALUE' => $order->phone ?? 'Не указан',
                    'VALUE_TYPE' => 'WORK'
                ]
            ],
            // Новые поля для лида
            'ADDRESS' => $request->input('address'),
            'ENTRANCE' => $request->input('entrance'),
            'FLOOR' => $request->input('floor'),
            'FLAT' => $request->input('flat'),
            'INTERCOM' => $request->input('intercom'),
            'COMMENT' => $request->input('comment'),
            'CITY' => $request->input('city'),
        ];

        $response = $this->bitrixService->createLead($leadData);
        if (isset($response['error'])) {
            Log::error('Ошибка при создании лида в Bitrix: ' . $response['error_description']);
        }
    }

    private function sendOrderEmail(User $user, Order $order)
    {
        $data = [
            'user' => $user,
            'order' => $order,
        ];

        SendEmailJob::dispatch($order->email, $data, 'emails.orderPlaced');
    }
}
