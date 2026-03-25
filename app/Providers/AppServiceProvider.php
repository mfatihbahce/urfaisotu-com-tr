<?php

namespace App\Providers;

use App\Services\CartService;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer(['layouts.front', 'layouts.account'], function ($view) {
            $view->with('cartItemCount', app(CartService::class)->itemCount());
        });
    }
}
