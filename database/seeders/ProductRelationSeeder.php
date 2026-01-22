<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Tag;
use App\Models\Platform;
use Illuminate\Database\Seeder;

class ProductRelationSeeder extends Seeder
{
    public function run(): void
    {
        $tags = Tag::pluck('id')->toArray();
        $platforms = Platform::pluck('id')->toArray();

        Product::all()->each(function ($product) use ($tags, $platforms) {
            // Asignar entre 1 y 3 tags
            $product->tags()->attach(
                collect($tags)->random(rand(1, 3))->toArray()
            );

            // Asignar entre 1 y 2 plataformas
            $product->platforms()->attach(
                collect($platforms)->random(rand(1, 2))->toArray()
            );
        });
    }
}
