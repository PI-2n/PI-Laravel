<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Http\Resources\OrderResource; // We might need a resource or just return JSON
use Illuminate\Http\Request;

class OrderController extends BaseController
{
    /**
     * Get order details.
     */
    public function show(Request $request, $id)
    {
        $order = Order::with(['items.product', 'payment'])->find($id);

        if (!$order) {
            return $this->sendError('Order not found', [], 404);
        }

        // Check authorization
        if ($order->user_id !== $request->user()->id) {
            return $this->sendError('Unauthorized', [], 403);
        }

        // Format response to match what SuccessView expects
        // SuccessView expects: id, created_at, total, payment_method, items
        // items should have: id, product_name, quantity, price

        $data = [
            'id' => $order->id,
            'created_at' => $order->created_at,
            'total' => $order->total,
            'payment_method' => $order->payment ? ($order->payment->payment_method === 'credit_card' ? 'Tarjeta de crédito' : $order->payment->payment_method) : 'N/A',
            'transaction_id' => $order->payment ? $order->payment->transaction_id : null,
            'items' => $order->items->map(function ($item) {
                return [
                    'id' => $item->id,
                    'product_name' => $item->product ? $item->product->name : 'Producto eliminado',
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                ];
            }),
        ];

        return $this->sendResponse($data, 'Order details retrieved');
    }
}
