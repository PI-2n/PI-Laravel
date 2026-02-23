<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CommentController extends Controller
{
    use AuthorizesRequests;

    public function store(Request $request, Product $product)
    {
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'message' => 'nullable|string|max:1000',
        ]);

        $existingComment = Comment::where('user_id', auth()->id())
            ->where('product_id', $product->id)
            ->first();

        if ($existingComment) {
            return redirect()->route('products.show', $product)
                ->with('error', 'Ya has dejado una opinión en este producto. Edítala si quieres cambiarla.');
        }

        Comment::create([
            'user_id' => auth()->id(),
            'product_id' => $product->id,
            'rating' => $validated['rating'],
            'message' => $validated['message'],
        ]);

        return redirect()->route('products.show', $product)
            ->with('success', 'Comentario añadido correctamente.');
    }

    public function update(Request $request, Comment $comment)
    {
        $this->authorize('update', $comment);

        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'message' => 'nullable|string|max:1000',
        ]);

        $comment->update($validated);

        return redirect()->route('products.show', $comment->product)
            ->with('success', 'Comentario actualizado.');
    }

    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);

        $product = $comment->product;
        $comment->delete();

        return redirect()->route('products.show', $product)
            ->with('success', 'Comentario eliminado.');
    }
}