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

        $cart = ShoppingCart::with('items.product')->where('user_id', $user->id)->first();

        return view('cart.index', compact('cart'));
    }

    public function add(Request $request, $productId)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para añadir productos al carrito.');
        }

        $product = Product::findOrFail($productId);

        $cart = ShoppingCart::firstOrCreate(['user_id' => $user->id]);

        $cartItem = ShoppingCartItem::where('shopping_cart_id', $cart->id)
            ->where('product_id', $product->id)
            ->first();

        if ($cartItem) {
            $cartItem->quantity += 1;
            $cartItem->line_total = $cartItem->quantity * $cartItem->unit_price;
            $cartItem->save();
        } else {
            ShoppingCartItem::create([
                'shopping_cart_id' => $cart->id,
                'product_id' => $product->id,
                'quantity' => 1,
                'unit_price' => $product->price,
                'line_total' => $product->price * 1,
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
        $cart = ShoppingCart::where('user_id', $user->id)->first();

        if ($cart) {
            $item = ShoppingCartItem::where('shopping_cart_id', $cart->id)->where('id', $itemId)->first();
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
        $cart = ShoppingCart::where('user_id', $user->id)->first();

        if ($cart) {
            $item = ShoppingCartItem::where('shopping_cart_id', $cart->id)->where('id', $itemId)->first();
            if ($item) {
                $item->delete();
            }
        }

        return redirect()->route('cart.index')->with('success', 'Producto eliminado del carrito.');
    }
}
