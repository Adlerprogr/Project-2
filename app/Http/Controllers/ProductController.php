<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
      public function productPage(int $id)
      {
          $product = Product::findOrFail($id);

          $products = Product::all();

          return view('product', compact('product', 'products'));
      }
}
