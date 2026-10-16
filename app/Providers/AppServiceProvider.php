<?php

namespace App\Providers;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
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
        View::composer('layouts.shop', function ($view) {
            $count = 0;

            if (Auth::check()) {
                $cart = Cart::where('user_id', Auth::id())->first();
                $count = $cart?->items()->sum('quantity') ?? 0;
            } elseif (Session::has('cart_session_id')) {
                $cart = Cart::where('session_id', Session::get('cart_session_id'))->first();
                $count = $cart?->items()->sum('quantity') ?? 0;
            }

            $view->with('cartCount', $count);
        });
    }
}