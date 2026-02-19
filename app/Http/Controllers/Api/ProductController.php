<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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

    public function index(Request $request)
    {
        $platform = $request->query('platform');
        $search = $request->query('q');

        // If no filter is provided, return empty collection (as requested)
        if (!$platform && !$search) {
            return ProductResource::collection(collect());
        }

        $query = Product::query()->where('active', true);

        if ($platform) {
            $query->whereHas('platforms', function ($q) use ($platform) {
                $q->where('name', 'like', "%{$platform}%");
            });
        }

        if ($search) {
            $query->where('name', 'like', "%{$search}%");
        }

        return ProductResource::collection($query->paginate(10));
    }

    public function home()
    {
        $featured = Product::where('active', true)
            ->where('is_new', true)
            ->where('sku', "P00010")
            ->whereNotNull('video_url')
            ->first();

        $news = Product::where('active', true)
            ->where('is_new', true)
            ->orderByDesc('release_date')
            ->take(10) // Limit for API
            ->get();

        $offers = Product::where('active', true)
            ->where('is_offer', true)
            ->orderByDesc('offer_percentage')
            ->get();

        return response()->json([
            'featured' => $featured ? new ProductResource($featured) : null,
            'news' => ProductResource::collection($news),
            'offers' => ProductResource::collection($offers),
        ]);
    }

    public function show(Product $product)
    {
        $product->load(['platforms', 'comments.user', 'tags']);

        // Get tags of the current product
        $tagIds = $product->tags->pluck('id');

        $related = collect();

        if ($tagIds->isNotEmpty()) {
            $related = Product::where('id', '!=', $product->id)
                ->where('active', true)
                ->whereHas('tags', function ($query) use ($tagIds) {
                    $query->whereIn('tags.id', $tagIds);
                })
                ->withCount([
                    'tags' => function ($query) use ($tagIds) {
                        $query->whereIn('tags.id', $tagIds);
                    }
                ])
                ->with('platforms')
                ->orderByDesc('tags_count')
                ->take(5)
                ->get();
        }

        return (new ProductResource($product))
            ->additional([
                'related_products' => ProductResource::collection($related)
            ]);
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @authenticated
     */
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
