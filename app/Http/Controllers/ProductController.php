<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
      public function productPage(int $id)
      {
          try {
              // Находим продукт или вызываем 404 ошибку
              $product = Product::findOrFail($id);
              Log::info("Запрос продукта с ID: $id");

              $products = Product::all();

              return view('product', compact('product', 'products'));
          } catch (\Exception $e) {
              Log::error("Ошибка при получении продукта с ID: $id - " . $e->getMessage());
              abort(404); // Или редирект на страницу ошибки
          }
      }
}
