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
            foreach ($users as $user) {
                Comment::factory()->create([
                    'product_id' => $product->id,
                    'user_id' => $user->id,
                ]);
            }
        }
    }
}
