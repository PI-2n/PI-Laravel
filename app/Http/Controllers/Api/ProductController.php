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

    public function show(Product $product)
    {
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
