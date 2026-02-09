<?php

namespace Database\Seeders;

use App\Models\ShoppingCartItem;
use App\Models\ShoppingCart;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ShoppingCartItemSeeder extends Seeder
{
    public function run(): void
    {
        $shoppingCarts = ShoppingCart::all();
        $products = Product::all();

        foreach ($shoppingCarts as $cart) {
            $itemsCount = rand(1, 3);
            $productsShuffled = $products->shuffle();

            for ($i = 0; $i < $itemsCount && $i < $productsShuffled->count(); $i++) {
                $product = $productsShuffled[$i];

                $quantity = rand(1, 5);
                $unitPrice = rand(10, 100);

                ShoppingCartItem::create([
                    'shopping_cart_id' => $cart->id,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'unit_price' => $unitPrice,
                    'line_total' => $quantity * $unitPrice,
                ]);
            }
        }
    }
}
