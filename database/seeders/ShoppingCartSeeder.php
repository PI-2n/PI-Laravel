<?php

namespace Database\Seeders;

use App\Models\ShoppingCart;
use App\Models\User;
use Illuminate\Database\Seeder;

class ShoppingCartSeeder extends Seeder
{
    public function run(): void
    {
        // Crear un único carrito para el primer usuario
        $user = User::first();
        
        if ($user) {
            ShoppingCart::create([
                'user_id' => $user->id,
                'status' => 'active',
            ]);
        }
    }
}