<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'price_with_offer',
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

    // Relación con comentarios
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
