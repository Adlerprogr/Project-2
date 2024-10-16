<?php

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

Route::group(['middleware' => 'auth'], function () {
    // Все маршруты в этой группе требуют авторизации
    Route::get('/main', [MainController::class, 'mainPage'])->name('main');

    Route::get('/cart', [CartController::class, 'cartPage'])->name('cart');

    Route::post('/plus-product', [CartController::class, 'add' ])->name('plus-product');
    Route::post('/delete-product', [CartController::class, 'remove' ])->name('delete-product');

//    Route::get('/product', [ProductController::class, 'index']);
    Route::get('/product/{id}', [ProductController::class, 'productPage'])->name('product.show');

    Route::get('/order', [OrderController::class, 'orderPage'])->name('order');
    Route::post('/order.add', [OrderController::class, 'addOrder'])->name('order.add');
});

//Route::resource('main', MainController::class);


