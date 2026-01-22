<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $featured = Product::where('active', true)
            ->where('is_new', true)
            ->whereNotNull('video_url')
            ->latest('release_date')
            ->first();

        $news = Product::where('active', true)
            ->where('is_new', true)
            ->orderByDesc('release_date')
            ->get();

        $offers = Product::where('active', true)
            ->where('is_offer', true)
            ->orderByDesc('offer_percentage')
            ->get();

        return view('index', compact('featured', 'news', 'offers'));
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
