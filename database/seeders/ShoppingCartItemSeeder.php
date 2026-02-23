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
        // Obtener solo carritos activos
        $shoppingCarts = ShoppingCart::where('status', 'active')->get();
        $products = Product::all();

        foreach ($shoppingCarts as $cart) {
            // 2-5 items por carrito
            $itemsCount = rand(2, 5);
            $productsShuffled = $products->shuffle();

            for ($i = 0; $i < $itemsCount && $i < $productsShuffled->count(); $i++) {
                $product = $productsShuffled[$i];

                // Obtener las plataformas del producto
                $platform = null;
                if ($product->platforms->count() > 0) {
                    $platform = $product->platforms->random();
                }

                $quantity = rand(1, 3);
                
                // USAR final_price para guardar el precio con descuento
                $unitPrice = $product->final_price;
                $lineTotal = $quantity * $unitPrice;

                ShoppingCartItem::create([
                    'shopping_cart_id' => $cart->id,
                    'product_id' => $product->id,
                    'platform_id' => $platform?->id,
                    'quantity' => $quantity,
                    'unit_price' => $unitPrice,
                    'line_total' => $lineTotal,
                ]);
            }
        }
    }
}