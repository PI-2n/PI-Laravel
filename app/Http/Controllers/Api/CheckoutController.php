<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CreditCard;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderPayment;
use App\Models\ShoppingCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class CheckoutController extends BaseController
{
    /**
     * Get checkout data (cart summary, total, saved cards)
     */
    /**
     * Get checkout data (cart summary, total, saved cards)
     * 
     * @authenticated
     */
    public function index(Request $request)
    {
        $user = $request->user();

        $cart = ShoppingCart::where('user_id', $user->id)
            ->where('status', 'active')
            ->with(['items.product', 'items.platform'])
            ->first();

        if (!$cart || $cart->items->count() === 0) {
            return $this->sendError('Cart is empty', ['error' => 'Tu carrito está vacío'], 400);
        }

        // Calculate total
        $total = $cart->items->sum('line_total');

        // Get saved cards
        $savedCards = CreditCard::where('user_id', $user->id)->get();

        return $this->sendResponse([
            'cart' => $cart,
            'total' => $total,
            'saved_cards' => $savedCards
        ], 'Checkout data retrieved');
    }

    /**
     * Process payment
     */
    /**
     * Process payment
     * 
     * @authenticated
     */
    public function processPayment(Request $request)
    {
        // Conditional validation based on payment method
        $rules = [
            'payment_method' => 'required|in:new_card,saved_card',
        ];

        if ($request->payment_method === 'saved_card') {
            $rules['card_id'] = 'required|exists:credit_cards,id,user_id,' . $request->user()->id;
        } elseif ($request->payment_method === 'new_card') {
            $rules['card_number'] = 'required|string|regex:/^[0-9\s]{13,23}$/';
            $rules['card_holder_name'] = 'required|string|max:255';
            $rules['expiration_date'] = 'required|string|regex:/^\d{2}\/\d{2}$/';
            $rules['cvv'] = 'required|numeric|digits_between:3,4';
            $rules['save_card'] = 'nullable|boolean';
        }

        $validator = \Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors(), 422);
        }

        $user = $request->user();

        \Log::info('Checkout Process Payment - User ID: ' . $user->id);

        $cart = ShoppingCart::where('user_id', $user->id)
            ->where('status', 'active')
            ->with('items.product')
            ->first();

        if (!$cart) {
            \Log::error('Checkout Process Payment - Cart not found for user ' . $user->id);
            return $this->sendError('Cart is empty (cart not found)', [], 400);
        }

        if ($cart->items->count() === 0) {
            \Log::error('Checkout Process Payment - Cart has no items', ['cart_id' => $cart->id]);
            return $this->sendError('Cart is empty (no items)', [], 400);
        }

        \Log::info('Checkout Process Payment - Cart found', ['cart_id' => $cart->id, 'item_count' => $cart->items->count()]);


        $total = $cart->items->sum('line_total');

        DB::beginTransaction();

        try {
            // 1. Create Order
            $order = Order::create([
                'user_id' => $user->id,
                'total' => $total,
                'status' => 'active',
            ]);

            // 2. Move cart items to order items
            foreach ($cart->items as $cartItem) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product_id,
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->unit_price,
                ]);
            }

            // 3. Save card if new and requested
            $creditCard = null;

            if ($request->payment_method === 'new_card' && $request->save_card) {
                // Remove spaces
                $cardNumber = preg_replace('/\s+/', '', $request->card_number);

                $creditCard = CreditCard::create([
                    'user_id' => $user->id,
                    'card_number' => $cardNumber,
                    'card_holder_name' => $request->card_holder_name,
                    'expiration_date' => $request->expiration_date,
                    'cvv' => $request->cvv,
                ]);
            } elseif ($request->payment_method === 'saved_card') {
                $creditCard = CreditCard::where('user_id', $user->id)
                    ->where('id', $request->card_id)
                    ->firstOrFail();
            }

            // 4. Record Payment
            $transactionId = 'TXN-' . strtoupper(uniqid());

            OrderPayment::create([
                'order_id' => $order->id,
                'credit_card_id' => $creditCard?->id,
                'amount' => $total,
                'status' => 'completed',
                'payment_method' => 'credit_card',
                'transaction_id' => $transactionId,
            ]);

            // 5. Mark cart as completed
            $cart->update(['status' => 'completed']);

            DB::commit();

            return $this->sendResponse(['order_id' => $order->id], 'Payment successful', 200);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error in API checkout: ' . $e->getMessage());

            return $this->sendError('Payment failed', ['error' => 'Hubo un error procesando tu pago.'], 500);
        }
    }
}
