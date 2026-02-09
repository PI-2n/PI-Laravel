<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingCartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'shopping_cart_id',
        'product_id',
        'platform_id',
        'quantity',
        'unit_price',
        'line_total',
    ];

    public function cart()
    {
        return $this->belongsTo(ShoppingCart::class, 'shopping_cart_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function platform()
    {
        return $this->belongsTo(Platform::class);
    }
}
