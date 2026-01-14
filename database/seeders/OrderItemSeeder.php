<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Database\Seeder;

class OrderItemSeeder extends Seeder
{
    public function run(): void
    {
        $orders = Order::all();
        $products = Product::all();

        foreach ($orders as $order) {
            $itemsCount = rand(1, 5);
            for ($i = 0; $i < $itemsCount; $i++) {
                $product = $products->random();
                OrderItem::factory()->create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                ]);
            }

            // Actualizar el total de la orden
            $total = $order->items()->sum('price');
            $order->update(['total' => $total]);
        }
    }
}
