<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'sku' => $this->sku,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'final_price' => $this->final_price,
            'image_url' => $this->image_url ? asset('images/products/' . $this->image_url) : null,
            'video_url' => $this->video_url ? asset('video/' . $this->video_url) : null,
            'is_new' => (bool) $this->is_new,
            'is_offer' => (bool) $this->is_offer,
            'offer_percentage' => $this->offer_percentage,
            'offer_start_date' => $this->offer_start_date,
            'offer_end_date' => $this->offer_end_date,
            'release_date' => $this->release_date,
            'active' => (bool) $this->active,
            'average_rating' => $this->average_rating,
            'platforms' => $this->whenLoaded('platforms'),
            'comments' => CommentResource::collection($this->whenLoaded('comments')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
