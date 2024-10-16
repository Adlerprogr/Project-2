<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
      public function productPage($id)
      {
          $product = Product::findOrFail($id);

          $products = Product::all();

          return view('product', compact('product', 'products'));
      }
}
