<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Tag;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        $featured = Product::where('active', true)
            ->where('is_new', true)
            ->where('sku',"P00010")
            ->whereNotNull('video_url')
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
            'tag_ids' => 'nullable|array',
            'tag_ids.*' => 'exists:tags,id',
            'image_url' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'video_url' => 'nullable|file|mimes:mp4,webm|max:10240',
            'is_offer' => 'nullable|boolean',
            'offer_percentage' => 'nullable|numeric|min:1|max:100',
            'offer_start_date' => 'nullable|date',
            'offer_end_date' => 'nullable|date|after_or_equal:offer_start_date',
            'active' => 'nullable|boolean',
        ]);

        $this->productService->createProduct(
            $validated,
            $request->file('image_url'),
            $request->file('video_url')
        );

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
            'tag_ids' => 'nullable|array',
            'tag_ids.*' => 'exists:tags,id',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'video_url' => 'nullable|file|mimes:mp4,webm|max:10240',
            'is_offer' => 'nullable|boolean',
            'offer_percentage' => 'nullable|numeric|min:0|max:100',
            'offer_start_date' => 'nullable|date',
            'offer_end_date' => 'nullable|date|after_or_equal:offer_start_date',
            'active' => 'nullable|boolean',
        ]);

        // Add 'featured' back to data if check makes sense, though not in validation rule above explicitly
        // The original controller handled 'featured' in logic but 'active' in validation.
        // Actually original controller checked `has('featured')` manually.
        // Let's pass it manually to service if it exist.
        $data = $validated;
        if ($request->has('featured')) {
            $data['featured'] = true;
        } else {
            // If checkbox is unchecked, it might not send anything.
            // Original logic: $product->is_new = $request->has('featured') ? 1 : 0;
            $data['featured'] = $request->has('featured');
        }

        // Active handling
        // Original: $product->active = $request->has('active') ? 1 : 0;
        // In validation we have 'active' => 'nullable|boolean'
        // If it's a checkbox, it sends '1' or 'on' if checked, nothing if not.
        // Let's ensure we pass the boolean.
        $data['active'] = $request->has('active');


        $this->productService->updateProduct(
            $product,
            $data,
            $request->file('image_url'),
            $request->file('video_url')
        );

        return redirect()->route('products.index')
            ->with('success', '¡Producto actualizado correctamente!');
    }

    public function destroy(Product $product)
    {
        $this->productService->deleteProduct($product);

        return redirect()->route('products.index')
            ->with('success', '¡Producto eliminado correctamente!');
    }
}
