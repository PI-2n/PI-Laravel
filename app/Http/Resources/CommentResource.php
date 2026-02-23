<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
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
            'user' => [
                'id' => $this->user->id,
                'name' => $this->user->name,
            ],
            'rating' => $this->rating,
            'content' => $this->message, // message in DB, content in Vue
            'message' => $this->message,
            'created_at' => $this->created_at,
            'formatted_date' => $this->created_at->format('d/m/Y'),
        ];
    }
}
