<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\UserProduct;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CartController;

class OrderController extends Controller
{
    private CartService $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function orderPage()
    {
        $cartController = new CartController($this->cartService);
        $cartPage = $cartController->cartPage();

        $userProducts = $cartPage['userProducts'];
        $totalQuantity = $cartPage['totalQuantity'];
        $totalPrice = $cartPage['totalPrice'];
        $deliveryAmount  = $cartPage['deliveryAmount'];
        $totalToBePaid = $cartPage['totalToBePaid'];

        return view('order', compact('userProducts', 'totalQuantity', 'totalPrice', 'deliveryAmount', 'totalToBePaid'));
    }

    public function addOrder(Request $request)
    {
        $userId = Auth::id();
        $arr = $request->all();

        $order = Order::create([
            'user_id' => $userId,
            'email' => $arr['email'],
            'phone' => $arr['phone'],
            'last_name' => $arr['last_name'],
            'address' => $arr['address'],
            'city' => $arr['city'],
            'comment' => $arr['comment'],
            'entrance' => $arr['entrance'],
            'floor' => $arr['floor'],
            'flat' => $arr['flat'],
            'intercom' => $arr['intercom'],
            'delivery_date' => $arr['delivery_date'],
            'delivery_time' => $arr['delivery_time']
        ]);

        $orderId = $order->id;

        $userProducts = UserProduct::where('user_id', $userId)->get();

        foreach ($userProducts as $userProduct) {
            $orderProduct = new OrderProduct([
                'product_id' => $userProduct->product_id,
                'order_id' => $orderId,
                'quantity' => $userProduct->quantity,
                'price' => 200
            ]);
            $orderProduct->save();
        }

        UserProduct::where('user_id', $userId)->delete();

        return redirect('/main');
    }
}
