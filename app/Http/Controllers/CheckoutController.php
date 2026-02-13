<?php

namespace App\Http\Controllers;

use App\Models\CreditCard;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderPayment;
use App\Models\ShoppingCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    /**
     * Mostrar la página de checkout
     */
    public function index()
    {
        $cart = ShoppingCart::where('user_id', auth()->id())
            ->where('status', 'active')
            ->with('items.product')
            ->first();

        if (!$cart || $cart->items->count() === 0) {
            return redirect()->route('cart.index')->with('error', 'Tu carrito está vacío');
        }

        // Calcular total
        $total = $cart->items->sum('line_total');

        // Obtener tarjetas guardadas del usuario
        $savedCards = CreditCard::where('user_id', auth()->id())->get();

        return view('checkout.index', compact('cart', 'total', 'savedCards'));
    }

    /**
     * Procesar el pago
     */
    public function processPayment(Request $request)
    {
        $request->validate([
            'payment_method' => 'required|in:new_card,saved_card',
            'card_id' => 'required_if:payment_method,saved_card',
            'card_number' => 'required_if:payment_method,new_card|numeric|digits_between:13,19',
            'card_holder_name' => 'required_if:payment_method,new_card|string|max:255',
            'expiration_date' => 'required_if:payment_method,new_card|string|regex:/^\d{2}\/\d{2}$/',
            'cvv' => 'required_if:payment_method,new_card|numeric|digits:3,4',
            'save_card' => 'nullable|boolean',
        ]);

        $cart = ShoppingCart::where('user_id', auth()->id())
            ->where('status', 'active')
            ->with('items.product')
            ->firstOrFail();

        $total = $cart->items->sum('line_total');

        DB::beginTransaction();

        try {
            // 1. Crear el pedido (Order)
            $order = Order::create([
                'user_id' => auth()->id(),
                'total' => $total,
                'status' => 'active',
            ]);

            // 2. Mover los items del carrito al pedido
            foreach ($cart->items as $cartItem) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product_id,
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->unit_price,
                ]);
            }

            // 3. Guardar tarjeta si es nueva y el usuario quiere guardarla
            $creditCard = null;
            
            if ($request->payment_method === 'new_card' && $request->save_card) {
                $creditCard = CreditCard::create([
                    'user_id' => auth()->id(),
                    'card_number' => $request->card_number,
                    'card_holder_name' => $request->card_holder_name,
                    'expiration_date' => $request->expiration_date,
                    'cvv' => $request->cvv,
                ]);
            } elseif ($request->payment_method === 'saved_card') {
                $creditCard = CreditCard::where('user_id', auth()->id())
                    ->where('id', $request->card_id)
                    ->firstOrFail();
            }

            // 4. Registrar el pago (simulado)
            $transactionId = 'TXN-' . strtoupper(uniqid());
            
            OrderPayment::create([
                'order_id' => $order->id,
                'credit_card_id' => $creditCard?->id,
                'amount' => $total,
                'status' => 'completed', // Simulamos que el pago fue exitoso
                'payment_method' => 'credit_card',
                'transaction_id' => $transactionId,
            ]);

            // 5. Marcar el carrito como completado
            $cart->update(['status' => 'completed']);

            DB::commit();

            // Redirigir a página de éxito
            return redirect()->route('checkout.success', $order->id)
                ->with('success', '¡Pago realizado con éxito!');

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Error en checkout: ' . $e->getMessage());
            
            return back()->withInput()->with('error', 'Hubo un error procesando tu pago. Por favor intenta nuevamente.');
        }
    }

    /**
     * Página de éxito
     */
    public function success($orderId)
    {
        $order = Order::with(['items.product', 'payment'])->findOrFail($orderId);
        
        // Verificar que el pedido pertenece al usuario
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        return view('checkout.success', compact('order'));
    }
}