<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ShoppingCart;
use App\Models\ShoppingCartItem;
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

                $platform = null;
                if ($product->platforms->count() > 0) {
                    $platform = $product->platforms->random();
                }

                $quantity = rand(1, 5);
                $price = $product->price;
                $discount = (float) ($product->offer_percentage ?? 0);
                $unitPrice = $discount > 0
                    ? $price * (1 - $discount / 100)
                    : $price;
                $unitPrice = round($unitPrice, 2);

                ShoppingCartItem::create([
                    'shopping_cart_id' => $cart->id,
                    'product_id' => $product->id,
                    'platform_id' => $platform?->id,
                    'quantity' => $quantity,
                    'unit_price' => $unitPrice,
                    'line_total' => $quantity * $unitPrice,
                ]);
            }
        }
    }
}
