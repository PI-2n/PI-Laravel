<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class CreditCard extends Model
{
    protected $fillable = [
        'user_id',
        'card_number',
        'card_holder_name',
        'expiration_date',
        'cvv',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    //
}
