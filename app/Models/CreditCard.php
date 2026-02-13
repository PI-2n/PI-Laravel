<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CreditCard extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'card_number',
        'card_holder_name',
        'expiration_date',
        'cvv',
    ];

    protected $hidden = [
        'cvv',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Método para mostrar el número de tarjeta enmascarado
    public function getMaskedCardNumberAttribute(): string
    {
        return '**** **** **** ' . substr($this->card_number, -4);
    }
}