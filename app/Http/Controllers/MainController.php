<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\UserProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class MainController extends Controller
{
    public function mainPage()
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

        return view('main', compact('products', 'totalQuantity'));
    }
}
