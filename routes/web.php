<?php

use App\Http\Controllers\AddProductController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\CartController;


Route::get('/', function () {
    return view('welcome');
})->middleware('auth');

Route::get('/register', [RegistrationController::class, 'showRegistrationForm'])->name('register');
Route::post ('/register', [RegistrationController::class, 'register']);

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login' ]);
Route:: post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::post('/images', [ImageController::class, 'store']);

Route::get('/products/create', [AddProductController::class, 'page'])->name('product.create');
Route::post('/products', [AddProductController::class, 'add'])->name('product.store');

Route::group(['middleware' => 'auth'], function () {
    // Все маршруты в этой группе требуют авторизации
    Route::get('/main/{showInUSD?}', [MainController::class, 'mainPage'])->name('main');

    Route::get('/cart', [CartController::class, 'cartPage'])->name('cart');

    Route::post('/plus-product', [CartController::class, 'add' ])->name('plus-product');
    Route::post('/delete-product', [CartController::class, 'remove' ])->name('delete-product');

    Route::get('/product/{id}', [ProductController::class, 'productPage'])->name('product.show');

    Route::get('/order', [OrderController::class, 'orderPage'])->name('order');
    Route::post('/order.add', [OrderController::class, 'addOrder'])->name('order.add');

    Route::post('/convert-prices', [MainController::class, 'convertPrices'])->name('convert.prices');
    Route::post('/show-in-rubles', [MainController::class, 'showInRubles'])->name('show.in.rubles');
});


