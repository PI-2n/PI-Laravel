<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Services\ProductService;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        return ProductResource::collection(Product::query()->paginate(10));
    }

    public function home()
    {
        $featured = Product::where('active', true)
            ->where('is_new', true)
            ->whereNotNull('video_url')
            ->latest('release_date')
            ->first();

        $news = Product::where('active', true)
            ->where('is_new', true)
            ->orderByDesc('release_date')
            ->take(10) // Limit for API
            ->get();

        $offers = Product::where('active', true)
            ->where('is_offer', true)
            ->orderByDesc('offer_percentage')
            ->take(10) // Limit for API
            ->get();

        return response()->json([
            'featured' => $featured ? new ProductResource($featured) : null,
            'news' => ProductResource::collection($news),
            'offers' => ProductResource::collection($offers),
        ]);
    }

    public function show(Product $product)
    {
        $product->load(['platforms', 'comments.user']);
        return new ProductResource($product);
    }

    public function store(ProductRequest $request)
    {
        // ProductRequest handles validation.
        // We need to pass data and files to service.
        $data = $request->validated();

        $product = $this->productService->createProduct(
            $data,
            $request->file('image_url'),
            $request->file('video_url')
        );

        return (new ProductResource($product))
            ->response()
            ->setStatusCode(201);
    }

    public function update(ProductRequest $request, Product $product)
    {
        // Debugging validation errors
        // Log::info('Update Product Request Data:', $request->all());

        $data = $request->validated();

        $product = $this->productService->updateProduct(
            $product,
            $data,
            $request->file('image_url'),
            $request->file('video_url')
        );

        return new ProductResource($product);
    }

    public function destroy(Product $product)
    {
        $this->productService->deleteProduct($product);

        return response()->noContent();
    }
}
