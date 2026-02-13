<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ShoppingCart;
use App\Models\ShoppingCartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }

        // Solo obtener carritos 'active'
        $cart = ShoppingCart::with('items.product')
            ->where('user_id', $user->id)
            ->where('status', 'active')
            ->first();

        // Si no hay carrito activo o está vacío, mostrar carrito vacío
        if (!$cart || $cart->items->count() === 0) {
            return view('cart.index', ['cart' => null]);
        }

        return view('cart.index', compact('cart'));
    }

    public function add(Request $request, $productId)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para añadir productos al carrito.');
        }

        $request->validate([
            'platform_id' => 'nullable|exists:platforms,id',
        ]);

        $product = Product::findOrFail($productId);
        $platformId = $request->input('platform_id');

        // Obtener o crear carrito activo
        $cart = ShoppingCart::where('user_id', $user->id)
            ->where('status', 'active')
            ->first();

        if (!$cart) {
            $cart = ShoppingCart::create([
                'user_id' => $user->id,
                'status' => 'active',
            ]);
        }

        $cartItem = ShoppingCartItem::where('shopping_cart_id', $cart->id)
            ->where('product_id', $product->id)
            ->where('platform_id', $platformId)
            ->first();

        if ($cartItem) {
            $cartItem->quantity += 1;
            $cartItem->line_total = $cartItem->quantity * $cartItem->unit_price;
            $cartItem->save();
        } else {
            // Usar final_price para guardar el precio con descuento
            $unitPrice = $product->final_price;
            
            ShoppingCartItem::create([
                'shopping_cart_id' => $cart->id,
                'product_id' => $product->id,
                'platform_id' => $platformId,
                'quantity' => 1,
                'unit_price' => $unitPrice,
                'line_total' => $unitPrice,
            ]);
        }
        
        return redirect()->back()->with('success', 'Producto añadido al carrito.');
    }

    public function update(Request $request, $itemId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $user = Auth::user();
        $cart = ShoppingCart::where('user_id', $user->id)
            ->where('status', 'active')
            ->first();

        if ($cart) {
            $item = ShoppingCartItem::where('shopping_cart_id', $cart->id)
                ->where('id', $itemId)
                ->first();
            
            if ($item) {
                $item->quantity = $request->quantity;
                $item->line_total = $item->quantity * $item->unit_price;
                $item->save();
            }
        }

        return redirect()->route('cart.index')->with('success', 'Cantidad actualizada.');
    }

    public function remove($itemId)
    {
        $user = Auth::user();
        $cart = ShoppingCart::where('user_id', $user->id)
            ->where('status', 'active')
            ->first();

        if ($cart) {
            $item = ShoppingCartItem::where('shopping_cart_id', $cart->id)
                ->where('id', $itemId)
                ->first();
            
            if ($item) {
                $item->delete();
            }
        }

        return redirect()->route('cart.index')->with('success', 'Producto eliminado del carrito.');
    }
}