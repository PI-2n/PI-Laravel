<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $products = Product::all();

        foreach ($products as $product) {
            // Mezclamos usuarios para asegurar combinaciones únicas
            $usersShuffled = $users->shuffle();

            // Cada producto tendrá entre 1 y 2 comentarios
            $commentsCount = rand(1, min(2, $usersShuffled->count()));

            for ($i = 0; $i < $commentsCount; $i++) {
                Comment::factory()->create([
                    'product_id' => $product->id,
                    'user_id' => $usersShuffled[$i]->id,
                ]);
            }
        }
    }
}
