<?php

namespace App\Providers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Изменение отправки писем по умолчанию
        Mail::alwaysTo('ваш_тестовый_адрес@debugmail.io');
        // Или используйте Mail::to('адрес') для конкретного адреса
    }
}
