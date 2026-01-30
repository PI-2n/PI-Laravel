<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'image_url' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'video_url' => 'nullable|file|mimes:mp4,webm|max:10240',
            'is_offer' => 'nullable|boolean',
            'offer_percentage' => 'nullable|numeric|min:1|max:100',
            'active' => 'nullable|boolean',
            'featured' => 'nullable|boolean',
        ]);

        // Guardar imagen
        $imagePath = $request->file('image_url')->store('products', 'public');

        // Guardar video si existe
        $videoPath = null;
        if ($request->hasFile('video_url')) {
            $videoPath = $request->file('video_url')->store('video', 'public');
        }

        Product::create([
            'name' => $validated['name'],
            'price' => $validated['price'],
            'description' => $validated['description'],
            'image_url' => basename($imagePath),
            'video_url' => $videoPath ? basename($videoPath) : null,
            'is_offer' => $request->has('is_offer') ? 1 : 0,
            'offer_percentage' => $validated['offer_percentage'] ?? null,
            'active' => $request->has('active') ? 1 : 1,
            'featured' => $request->has('featured') ? 1 : 0,
            'is_new' => 0, // Mantenemos tu campo is_new
        ]);

        return redirect()->route('products.index')
            ->with('success', '¡Producto creado correctamente!');
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric',
            'description' => 'required',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'video_url' => 'nullable|file|mimes:mp4,webm|max:10240',
            'is_offer' => 'nullable|boolean',
            'offer_percentage' => 'nullable|numeric|min:1|max:100',
            'active' => 'nullable|boolean',
            'featured' => 'nullable|boolean',
        ]);

        // Actualizar imagen si se proporciona
        if ($request->hasFile('image_url')) {
            // Eliminar imagen anterior si existe
            if ($product->image_url) {
                Storage::disk('public')->delete('products/' . $product->image_url);
            }
            
            $imagePath = $request->file('image_url')->store('products', 'public');
            $product->image_url = basename($imagePath);
        }

        // Actualizar video si se proporciona
        if ($request->hasFile('video_url')) {
            // Eliminar video anterior si existe
            if ($product->video_url) {
                Storage::disk('public')->delete('video/' . $product->video_url);
            }
            
            $videoPath = $request->file('video_url')->store('video', 'public');
            $product->video_url = basename($videoPath);
        }

        $product->name = $validated['name'];
        $product->price = $validated['price'];
        $product->description = $validated['description'];
        $product->is_offer = $request->has('is_offer') ? 1 : 0;
        $product->offer_percentage = $validated['offer_percentage'] ?? null;
        $product->active = $request->has('active') ? 1 : 0;
        $product->featured = $request->has('featured') ? 1 : 0;
        // Mantenemos is_new sin modificarlo desde el formulario

        $product->save();

        return redirect()->route('products.index')
            ->with('success', '¡Producto actualizado correctamente!');
    }

    public function destroy(Product $product)
    {
        // Eliminar imagen
        if ($product->image_url) {
            Storage::disk('public')->delete('products/' . $product->image_url);
        }

        // Eliminar video
        if ($product->video_url) {
            Storage::disk('public')->delete('video/' . $product->video_url);
        }

        $product->delete();

        return redirect()->route('products.index')
            ->with('success', '¡Producto eliminado correctamente!');
    }
}