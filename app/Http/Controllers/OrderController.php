<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\UserProduct;
use App\Services\CartService;
use App\Services\RabbitMQService;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    private CartService $cartService;
    private RabbitMQService $rabbitMQService;

    public function __construct(CartService $cartService, RabbitMQService $rabbitMQService)
    {
        $this->cartService = $cartService;
        $this->rabbitMQService = $rabbitMQService;
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
        $userId = Auth::id();
        $order = Order::create(array_merge($request->all(), ['user_id' => $userId]));

        $orderId = $order->id;
        $userProducts = UserProduct::where('user_id', $userId)->get();

        foreach ($userProducts as $userProduct) {
            OrderProduct::create([
                'product_id' => $userProduct->product_id,
                'order_id' => $orderId,
                'quantity' => $userProduct->quantity,
                'price' => 200,
            ]);
        }

        UserProduct::where('user_id', $userId)->delete();
        $user = Auth::user(); // Получаем текущего пользователя

        // Отправляем данные в очередь RabbitMQ
        $this->rabbitMQService->publishMessage('email_queue', [
            'email' => $order->email,
            'user' => $user->id,
            'order' => $order->id,
            'view' => 'emails.orderPlaced',
        ]);

        return redirect('/main');
    }
}
