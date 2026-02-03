<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class ProductService
{
    /**
     * Create a new product.
     */
    public function createProduct(array $data, ?UploadedFile $image = null, ?UploadedFile $video = null): Product
    {
        // Handle Image
        if ($image) {
            $imagePath = $image->store('products', 'public');
            $data['image_url'] = basename($imagePath);
        }

        // Handle Video
        if ($video) {
            $videoPath = $video->store('video', 'public');
            $data['video_url'] = basename($videoPath);
        }

        // Handle Offer Dates
        $this->handleOfferDates($data);

        // Handle Tags (separate from main create)
        $tagId = $data['tag_id'] ?? null;
        unset($data['tag_id']);

        // Default valid fields for creation
        $data['release_date'] = now();
        $data['is_new'] = 1;

        $product = Product::create($data);

        if ($tagId) {
            $product->tags()->attach($tagId);
        }

        return $product;
    }

    /**
     * Update an existing product.
     */
    public function updateProduct(Product $product, array $data, ?UploadedFile $image = null, ?UploadedFile $video = null): Product
    {
        // Handle Image
        if ($image) {
            if ($product->image_url) {
                Storage::disk('public')->delete('products/' . $product->image_url);
            }
            $imagePath = $image->store('products', 'public');
            $data['image_url'] = basename($imagePath);
        }

        // Handle Video
        if ($video) {
            if ($product->video_url) {
                Storage::disk('public')->delete('video/' . $product->video_url);
            }
            $videoPath = $video->store('video', 'public');
            $data['video_url'] = basename($videoPath);
        }

        // Handle Offer Dates
        $this->handleOfferDates($data);

        // Handle Tags
        if (isset($data['tag_id'])) {
            $product->tags()->sync($data['tag_id'] ? [$data['tag_id']] : []);
            unset($data['tag_id']);
        }

        // Handle 'featured' checkbox mapping for 'is_new' if present
        if (isset($data['featured'])) {
            $data['is_new'] = $data['featured'] ? 1 : 0;
            unset($data['featured']);
        }

        $product->update($data);

        return $product;
    }

    /**
     * Delete a product.
     */
    public function deleteProduct(Product $product): void
    {
        if ($product->image_url) {
            Storage::disk('public')->delete('products/' . $product->image_url);
        }

        if ($product->video_url) {
            Storage::disk('public')->delete('video/' . $product->video_url);
        }

        $product->delete();
    }

    /**
     * Helper to handle offer dates logic.
     */
    protected function handleOfferDates(array &$data): void
    {
        $isOffer = isset($data['is_offer']) && (bool) $data['is_offer'];
        $data['is_offer'] = $isOffer ? 1 : 0;

        if ($isOffer) {
            $data['offer_start_date'] = now();
            $data['offer_end_date'] = isset($data['offer_end_date']) ? \Carbon\Carbon::parse($data['offer_end_date']) : null;
        } else {
            $data['offer_start_date'] = isset($data['offer_start_date']) ? \Carbon\Carbon::parse($data['offer_start_date']) : null;
            $data['offer_end_date'] = isset($data['offer_end_date']) ? \Carbon\Carbon::parse($data['offer_end_date']) : null;
        }
    }
}
