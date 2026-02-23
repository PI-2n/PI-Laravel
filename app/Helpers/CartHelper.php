<?php

namespace App\Helpers;

use App\Models\ShoppingCart;
use Illuminate\Support\Facades\Auth;

class CartHelper
{
    public static function getCount()
    {
        if (!Auth::check()) {
            return 0;
        }

        $cart = ShoppingCart::where('user_id', Auth::id())
            ->where('status', 'active')
            ->with('items')
            ->first();
        
        return $cart ? $cart->items->sum('quantity') : 0;
    }
}