<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Tag;
use App\Models\Platform;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'sku' => 'P00001',
                'name' => 'Hollow Knight 2: Silksong',
                'description' => 'Embárcate en una nueva aventura épica en el universo de Hollow Knight. En Silksong controlarás a Hornet, explorando reinos desconocidos llenos de enemigos desafiantes, secretos ocultos y un combate ágil y preciso. Con un estilo artístico dibujado a mano, una banda sonora envolvente y una jugabilidad metroidvania refinada, este título promete una experiencia intensa tanto para fans como para nuevos jugadores.',
                'image_url' => 'cover_silksong.jpg',
                'video_url' => 'hollow_knight_silksong.mp4',
                'price' => 20,
                'is_new' => true,
                'is_offer' => false,
                'offer_percentage' => null,
                'offer_start_date' => null,
                'offer_end_date' => null,
                'release_date' => Carbon::now()->subDays(10),
                'active' => true,
                'tags' => ['Aventura', 'Plataformas', 'Indie'],
                'platforms' => ['PC', 'PlayStation 5', 'Xbox Series X', 'Nintendo Switch'],
            ],
            [
                'sku' => 'P00002',
                'name' => 'Celeste',
                'description' => 'Celeste es un plataformas desafiante y emotivo que combina una jugabilidad precisa con una historia profunda sobre la superación personal. Acompaña a Madeline en su ascenso a la montaña Celeste, enfrentando niveles cuidadosamente diseñados, mecánicas ingeniosas y una banda sonora inolvidable.',
                'image_url' => 'cover_celeste.jpg',
                'video_url' => 'celeste.mp4',
                'price' => 10,
                'is_new' => true,
                'is_offer' => false,
                'offer_percentage' => null,
                'offer_start_date' => null,
                'offer_end_date' => null,
                'release_date' => Carbon::now()->subDays(30),
                'active' => true,
                'tags' => ['Plataformas', 'Indie'],
                'platforms' => ['PC', 'PlayStation 5', 'Xbox Series X', 'Nintendo Switch'],
            ],
            [
                'sku' => 'P00003',
                'name' => "Baldur's Gate III",
                'description' => "Sumérgete en un RPG épico ambientado en el universo de Dungeons & Dragons. Baldur's Gate III ofrece una narrativa rica, decisiones que influyen directamente en la historia y un sistema de combate por turnos profundo y estratégico.",
                'image_url' => 'cover_baldurs_gate.jpg',
                'video_url' => 'baldurs_gate.mp4',
                'price' => 40,
                'is_new' => true,
                'is_offer' => false,
                'offer_percentage' => null,
                'offer_start_date' => null,
                'offer_end_date' => null,
                'release_date' => Carbon::now()->subDays(60),
                'active' => true,
                'tags' => ['RPG', 'Aventura'],
                'platforms' => ['PC', 'PlayStation 5', 'Xbox Series X'],
            ],
            [
                'sku' => 'P00004',
                'name' => 'Borderlands 4',
                'description' => 'La saga looter-shooter regresa con más acción, humor y caos que nunca. Borderlands 4 ofrece intensos combates en primera persona, millones de armas y un estilo visual inconfundible.',
                'image_url' => 'cover_borderlands4.jpg',
                'video_url' => null,
                'price' => 30,
                'is_new' => false,
                'is_offer' => true,
                'offer_percentage' => 10,
                'offer_start_date' => Carbon::now()->subDays(5),
                'offer_end_date' => Carbon::now()->addDays(20),
                'release_date' => Carbon::now()->subMonths(6),
                'active' => true,
                'tags' => ['Shooter', 'Acción', 'Multijugador'],
                'platforms' => ['PC', 'PlayStation 5', 'Xbox Series X'],
            ],
            [
                'sku' => 'P00005',
                'name' => 'Cuphead',
                'description' => 'Cuphead es un juego de acción clásico inspirado en los dibujos animados de los años 30, con animaciones dibujadas a mano y música jazz original.',
                'image_url' => 'cover_cuphead.jpg',
                'video_url' => null,
                'price' => 8,
                'is_new' => false,
                'is_offer' => true,
                'offer_percentage' => 15,
                'offer_start_date' => Carbon::now()->subDays(10),
                'offer_end_date' => Carbon::now()->addDays(15),
                'release_date' => Carbon::now()->subYears(3),
                'active' => true,
                'tags' => ['Acción', 'Plataformas', 'Indie'],
                'platforms' => ['PC', 'PlayStation 5', 'Xbox Series X', 'Nintendo Switch'],
            ],
            [
                'sku' => 'P00006',
                'name' => 'Deep Rock Galactic Survivor',
                'description' => 'Un spin-off de acción y supervivencia ambientado en el universo de Deep Rock Galactic.',
                'image_url' => 'cover_deep_rock_galactic.jpg',
                'video_url' => null,
                'price' => 20,
                'is_new' => false,
                'is_offer' => true,
                'offer_percentage' => 5,
                'offer_start_date' => Carbon::now()->subDays(3),
                'offer_end_date' => Carbon::now()->addDays(30),
                'release_date' => Carbon::now()->subMonths(4),
                'active' => true,
                'tags' => ['Acción', 'Shooter', 'Multijugador'],
                'platforms' => ['PC'],
            ],
            [
                'sku' => 'P00007',
                'name' => 'Hogwarts Legacy',
                'description' => 'Vive tu propia historia en el mundo mágico de Harry Potter.',
                'image_url' => 'cover_hogwarts_legacy.jpg',
                'video_url' => null,
                'price' => 35,
                'is_new' => false,
                'is_offer' => true,
                'offer_percentage' => 12,
                'offer_start_date' => Carbon::now()->subDays(7),
                'offer_end_date' => Carbon::now()->addDays(25),
                'release_date' => Carbon::now()->subYear(),
                'active' => true,
                'tags' => ['RPG', 'Aventura'],
                'platforms' => ['PC', 'PlayStation 5', 'Xbox Series X', 'Nintendo Switch'],
            ],
            [
                'sku' => 'P00008',
                'name' => 'Pokemon Legends Z/A',
                'description' => 'Explora una nueva visión del mundo Pokémon con Pokémon Legends: Z-A.',
                'image_url' => 'cover_pokemon_legends_ZA.jpg',
                'video_url' => null,
                'price' => 55,
                'is_new' => false,
                'is_offer' => true,
                'offer_percentage' => 5,
                'offer_start_date' => Carbon::now()->subDays(2),
                'offer_end_date' => Carbon::now()->addDays(10),
                'release_date' => Carbon::now()->subMonths(2),
                'active' => true,
                'tags' => ['RPG', 'Aventura'],
                'platforms' => ['Nintendo Switch'],
            ],
            [
                'sku' => 'P00009',
                'name' => 'Windows 11 OEM',
                'description' => 'Windows 11 OEM es el sistema operativo de Microsoft diseñado para ofrecer mayor rendimiento, seguridad y una interfaz moderna.',
                'image_url' => 'cover_windows11.jpg',
                'video_url' => null,
                'price' => 10,
                'is_new' => false,
                'is_offer' => true,
                'offer_percentage' => 80,
                'offer_start_date' => Carbon::now()->subDays(1),
                'offer_end_date' => Carbon::now()->addDays(60),
                'release_date' => Carbon::now()->subMonths(18),
                'active' => true,
                'tags' => ['Productividad'],
                'platforms' => ['PC'],
            ],
        ];

        foreach ($products as $productData) {
            // Extraer los tags y platforms antes de crear el producto
            $tagNames = $productData['tags'] ?? [];
            $platformNames = $productData['platforms'] ?? [];
            unset($productData['tags'], $productData['platforms']);
            
            // Crear el producto
            $product = Product::create($productData);
            
            // Asignar los tags si existen
            if (!empty($tagNames)) {
                $tagIds = Tag::whereIn('name', $tagNames)->pluck('id');
                $product->tags()->attach($tagIds);
            }
            
            // Asignar las plataformas si existen
            if (!empty($platformNames)) {
                $platformIds = Platform::whereIn('name', $platformNames)->pluck('id');
                $product->platforms()->attach($platformIds);
            }
        }
    }
}