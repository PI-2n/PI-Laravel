<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        // Obtenemos los productos para el catálogo
        $products = Product::where('active', true)->get();
        return view('products.index', compact('products'));
    }

    public function show(Product $product)
    {
        // Cargamos las relaciones para ver comentarios y sus autores
        $product->load('comments.user');
        return view('products.show', compact('product'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric',
            'description' => 'required',
        ]);

        Product::create($validated);

        return redirect()->route('products.index')
                         ->with('success', '¡Producto creado correctamente!');
    }
}