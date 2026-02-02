<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

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
        $product->load('comments.user', 'tags');
        return view('products.show', compact('product'));
    }

    public function create()
    {
        // Cargar todos los tags para el select
        $tags = Tag::orderBy('name')->get();
        return view('products.create', compact('tags'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'sku' => 'required|string|max:50|unique:products,sku',
            'name' => 'required|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'required',
            'tag_id' => 'nullable|exists:tags,id',
            'image_url' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'video_url' => 'nullable|file|mimes:mp4,webm|max:10240',
            'is_offer' => 'nullable|boolean',
            'offer_percentage' => 'nullable|numeric|min:1|max:100',
            'offer_start_date' => 'nullable|date',
            'offer_end_date' => 'nullable|date|after_or_equal:offer_start_date',
            'active' => 'nullable|boolean',
        ]);

        // Generar SKU automáticamente si no se proporciona
        $sku = $validated['sku'];

        // Guardar imagen
        $imagePath = $request->file('image_url')->store('products', 'public');

        // Guardar video si existe
        $videoPath = null;
        if ($request->hasFile('video_url')) {
            $videoPath = $request->file('video_url')->store('video', 'public');
        }

        // Manejar fechas de oferta
        $offerStartDate = null;
        $offerEndDate = null;
        $isOffer = $request->has('is_offer');

        if ($isOffer) {
            // Si está en oferta ahora, fecha de inicio es hoy
            $offerStartDate = now();
            $offerEndDate = $request->offer_end_date ? \Carbon\Carbon::parse($request->offer_end_date) : null;
        } else {
            // Si no está en oferta ahora, usar fechas programadas
            $offerStartDate = $request->offer_start_date ? \Carbon\Carbon::parse($request->offer_start_date) : null;
            $offerEndDate = $request->offer_end_date ? \Carbon\Carbon::parse($request->offer_end_date) : null;
        }

        // Crear producto
        $product = Product::create([
            'sku' => $sku,
            'name' => $validated['name'],
            'price' => $validated['price'],
            'description' => $validated['description'],
            'image_url' => basename($imagePath),
            'video_url' => $videoPath ? basename($videoPath) : null,
            'is_offer' => $isOffer ? 1 : 0,
            'offer_percentage' => $validated['offer_percentage'] ?? null,
            'offer_start_date' => $offerStartDate,
            'offer_end_date' => $offerEndDate,
            'release_date' => now(),
            'active' => $request->has('active') ? 1 : 1,
            'is_new' => 1,
        ]);

        if ($request->has('tag_id') && $request->tag_id) {
            $product->tags()->attach($request->tag_id);
        }

        return redirect()->route('products.index')
            ->with('success', '¡Producto creado correctamente!');
    }

    public function edit(Product $product)
    {
        $tags = Tag::orderBy('name')->get();
        return view('products.edit', compact('product', 'tags'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'sku' => 'required|string|max:50|unique:products,sku,' . $product->id,
            'name' => 'required|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'required',
            'tag_id' => 'nullable|exists:tags,id',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'video_url' => 'nullable|file|mimes:mp4,webm|max:10240',
            'is_offer' => 'nullable|boolean',
            'offer_percentage' => 'nullable|numeric|min:1|max:100',
            'offer_start_date' => 'nullable|date',
            'offer_end_date' => 'nullable|date|after_or_equal:offer_start_date',
            'active' => 'nullable|boolean',
        ]);

        // Actualizar imagen si se proporciona
        if ($request->hasFile('image_url')) {
            if ($product->image_url) {
                Storage::disk('public')->delete('products/' . $product->image_url);
            }
            $imagePath = $request->file('image_url')->store('products', 'public');
            $product->image_url = basename($imagePath);
        }

        // Actualizar video si se proporciona
        if ($request->hasFile('video_url')) {
            if ($product->video_url) {
                Storage::disk('public')->delete('video/' . $product->video_url);
            }
            $videoPath = $request->file('video_url')->store('video', 'public');
            $product->video_url = basename($videoPath);
        }

        // Manejar fechas de oferta
        $isOffer = $request->has('is_offer');
        
        if ($isOffer) {
            $offerStartDate = now();
            $offerEndDate = $request->offer_end_date ? \Carbon\Carbon::parse($request->offer_end_date) : null;
        } else {
            $offerStartDate = $request->offer_start_date ? \Carbon\Carbon::parse($request->offer_start_date) : null;
            $offerEndDate = $request->offer_end_date ? \Carbon\Carbon::parse($request->offer_end_date) : null;
        }

        $product->sku = $validated['sku'];
        $product->name = $validated['name'];
        $product->price = $validated['price'];
        $product->description = $validated['description'];
        $product->is_offer = $isOffer ? 1 : 0;
        $product->offer_percentage = $validated['offer_percentage'] ?? null;
        $product->offer_start_date = $offerStartDate;
        $product->offer_end_date = $offerEndDate;
        $product->active = $request->has('active') ? 1 : 0;
        $product->is_new = $request->has('featured') ? 1 : 0;

        $product->save();

        // Actualizar tag
        if ($request->has('tag_id')) {
            $product->tags()->sync($request->tag_id ? [$request->tag_id] : []);
        }

        return redirect()->route('products.index')
            ->with('success', '¡Producto actualizado correctamente!');
    }

    public function destroy(Product $product)
    {
        if ($product->image_url) {
            Storage::disk('public')->delete('products/' . $product->image_url);
        }

        if ($product->video_url) {
            Storage::disk('public')->delete('video/' . $product->video_url);
        }

        $product->delete();

        return redirect()->route('products.index')
            ->with('success', '¡Producto eliminado correctamente!');
    }
}