<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'sku',
        'name',
        'description',
        'price',
        'image_url',
        'video_url',
        'is_new',
        'is_offer',
        'offer_percentage',
        'offer_start_date',
        'offer_end_date',
        'release_date',
        'active',
    ];

    // Comentarios
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // Tags (N a N)
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'product_tag', 'product_id', 'tag_id');
    }

    // Platforms (N a N)
    public function platforms()
    {
        return $this->belongsToMany(Platform::class);
    }

    public function getFinalPriceAttribute()
    {
        if ($this->is_offer && $this->offer_percentage) {
            return $this->price * (1 - $this->offer_percentage / 100);
        }

        return $this->price;
    }
}
