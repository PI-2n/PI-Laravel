<?php

namespace App\Providers;

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
        view()->composer('*', function ($view) {
            if (auth()->check()) {
                $cart = \App\Models\ShoppingCart::where('user_id', auth()->id())->first();
                $cartCount = $cart ? $cart->items->sum('quantity') : 0;
            } else {
                $cartCount = 0;
            }
            $view->with('cartCount', $cartCount);
        });
    }
}
