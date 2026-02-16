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
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images/products'), $imageName);
            $data['image_url'] = $imageName;
        }

        // Handle Video
        if ($video) {
            $videoName = time() . '_' . $video->getClientOriginalName();
            $video->move(public_path('video'), $videoName);
            $data['video_url'] = $videoName;
        }

        // Handle Offer Dates
        $this->handleOfferDates($data);

        // Handle Tags
        $tagIds = $data['tag_ids'] ?? [];
        unset($data['tag_ids']);
        // Remove legacy tag_id if present
        if (isset($data['tag_id']))
            unset($data['tag_id']);

        // Default valid fields for creation
        $data['release_date'] = now();

        // Handle 'featured' checkbox mapping for 'is_new'
        if (isset($data['featured'])) {
            $data['is_new'] = $data['featured'] ? 1 : 0;
            unset($data['featured']);
        } else {
            $data['is_new'] = 1;
        }

        $product = Product::create($data);

        if (!empty($tagIds)) {
            $product->tags()->sync($tagIds);
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
            // Delete old image
            if ($product->image_url && file_exists(public_path('images/products/' . $product->image_url))) {
                unlink(public_path('images/products/' . $product->image_url));
            }

            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images/products'), $imageName);
            $data['image_url'] = $imageName;
        }

        // Handle Video
        if ($video) {
            // Delete old video
            if ($product->video_url && file_exists(public_path('video/' . $product->video_url))) {
                unlink(public_path('video/' . $product->video_url));
            }

            $videoName = time() . '_' . $video->getClientOriginalName();
            $video->move(public_path('video'), $videoName);
            $data['video_url'] = $videoName;
        }

        // Handle Offer Dates
        $this->handleOfferDates($data);

        // Handle Tags
        if (isset($data['tag_ids'])) {
            $product->tags()->sync($data['tag_ids']);
            unset($data['tag_ids']);
        }
        // Remove legacy tag_id if present
        if (isset($data['tag_id']))
            unset($data['tag_id']);

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
        if ($product->image_url && file_exists(public_path('images/products/' . $product->image_url))) {
            unlink(public_path('images/products/' . $product->image_url));
        }

        if ($product->video_url && file_exists(public_path('video/' . $product->video_url))) {
            unlink(public_path('video/' . $product->video_url));
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
            $data['offer_percentage'] = null;
        }
    }
}
