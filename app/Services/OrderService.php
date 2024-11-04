<?php

namespace App\Services;

use App\DTO\OrderDTO;
use App\Jobs\CreateLeadJob;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Jobs\SendEmailJob;

class OrderService
{
    private BitrixService $bitrixService;
    private OrderProductService  $orderProductService;
    private CartService  $cartService;

    public function __construct(BitrixService $bitrixService, OrderProductService $orderProductService, CartService $cartService)
    {
        $this->bitrixService = $bitrixService;
        $this->orderProductService = $orderProductService;
        $this->cartService = $cartService;
    }

    public function createOrder(OrderDTO $orderData)
    {
        try {
            DB::transaction(function () use ($orderData, &$order) {
                $order = $this->createOrderRecord($orderData);
                $this->orderProductService->createOrderProducts($order->id, $orderData->userId);
                $this->cartService->clearUserProducts($orderData->userId);
            });

            // Создаем лид и отправляем email асинхронно
            $this->queueLeadCreation($orderData, $order);
            $this->queueOrderEmail($orderData, $order);
        } catch (\Exception $e) {
            Log::error('Ошибка при создании заказа: ' . $e->getMessage(), [
                'user_id' => $orderData->userId, // если доступно
                'order_data' => $orderData, // подробные данные заказа
            ]);

            throw $e;
        }
    }

    private function createOrderRecord(OrderDTO $orderData): Order
    {
        return Order::create([
            'user_id' => $orderData->userId,
            'last_name' => $orderData->lastName,
            'email' => $orderData->email,
            'phone' => $orderData->phone,
            'address' => $orderData->address,
            'entrance' => $orderData->entrance,
            'floor' => $orderData->floor,
            'flat' => $orderData->flat,
            'intercom' => $orderData->intercom,
            'comment' => $orderData->comment,
            'city' => $orderData->city,
        ]);
    }

    private function prepareLeadData(OrderDTO $orderData, Order $order): array
    {
        return [
            'TITLE' => 'Заказ #' . $order->id,
            'LAST_NAME' => $orderData->lastName,
            'EMAIL' => [['VALUE' => $orderData->email, 'VALUE_TYPE' => 'WORK']],
            'PHONE' => [['VALUE' => $orderData->phone, 'VALUE_TYPE' => 'WORK']],
            'ADDRESS' => $orderData->address,
            'ENTRANCE' => $orderData->entrance,
            'FLOOR' => $orderData->floor,
            'FLAT' => $orderData->flat,
            'INTERCOM' => $orderData->intercom,
            'COMMENT' => $orderData->comment,
            'CITY' => $orderData->city,
        ];
    }

    private function queueLeadCreation(OrderDTO $orderData, Order $order)
    {
        $leadData = $this->prepareLeadData($orderData, $order);

        // Используем специализированный Job для создания лида
        dispatch(new CreateLeadJob($leadData, $this->bitrixService));
    }

    private function queueOrderEmail(OrderDTO $orderData, Order $order)
    {
        // Используем очередь для отправки email
        SendEmailJob::dispatch($orderData->email, ['order' => $order], 'emails.orderPlaced');
    }
}
