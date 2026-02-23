<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'rating',
        'message',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    protected static function booted()
    {
        static::saved(function ($comment) {
            $comment->updateProductAverageRating();
        });

        static::deleted(function ($comment) {
            $comment->updateProductAverageRating();
        });
    }

    public function updateProductAverageRating()
    {
        $product = $this->product;
        if ($product) {
            $average = $product->comments()->avg('rating') ?? 0;
            $product->update(['average_rating' => $average]);
        }
    }
}
