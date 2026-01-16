<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Guarda el comentario y regresa a la ficha del producto.
     */
    public function store(Request $request)
    {
        // Validamos asegurando que product_id existe en la tabla products
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'message'    => 'required|min:5',
            'rating'     => 'required|integer|min:1|max:5',
        ]);

        // Buscamos el producto primero para asegurar la integridad
        $product = Product::findOrFail($request->product_id);

        // Creamos el comentario usando la relación para evitar errores de ID
        $product->comments()->create([
            'user_id' => auth()->id() ?? 1, // Cambiar a auth()->id() cuando tengas login
            'message' => $request->message,
            'rating'  => $request->rating,
        ]);

        // Redirigimos especificando el parámetro 'product' que es el que espera Route::resource
        return redirect()->route('products.show', ['product' => $product->id])
                         ->with('success', '¡Gracias por tu comentario!');
    }
}