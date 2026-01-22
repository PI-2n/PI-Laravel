<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        $price = $this->faker->randomFloat(2, 10, 200);
        $hasOffer = $this->faker->boolean(30);
        $offerPercentage = $hasOffer ? $this->faker->numberBetween(5, 50) : null;

        return [
            'sku' => 'P' . str_pad($this->faker->unique()->numberBetween(1, 99999), 5, '0', STR_PAD_LEFT),

            'name' => $this->faker->words(3, true),
            'description' => $this->faker->sentence(10),
            'price' => $price,
            'image_url' => $this->faker->imageUrl(640, 480, 'games', true),
            'video_url' => $this->faker->boolean(50)
                ? strtolower(str_replace(' ', '_', $this->faker->words(2, true))) . '.mp4'
                : null,
            'is_new' => $this->faker->boolean(50),
            'is_offer' => $hasOffer,
            'offer_percentage' => $offerPercentage,
            'offer_start_date' => $hasOffer ? $this->faker->dateTimeBetween('-1 month', 'now') : null,
            'offer_end_date' => $hasOffer ? $this->faker->dateTimeBetween('now', '+1 month') : null,
            'release_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'active' => true,
        ];
    }
}
