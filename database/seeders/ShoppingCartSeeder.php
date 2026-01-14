<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ShoppingCart;
use App\Models\User;

class ShoppingCartSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();

        foreach ($users as $user) {
            ShoppingCart::create([
                'user_id' => $user->id,
                'status' => 'active',
            ]);
        }
    }
}
