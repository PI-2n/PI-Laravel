<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    public function run(): void
    {
        Tag::create(['name' => 'Acción']);
        Tag::create(['name' => 'Aventura']);
        Tag::create(['name' => 'RPG']);
        Tag::create(['name' => 'Plataformas']);
        Tag::create(['name' => 'Indie']);
        Tag::create(['name' => 'Estrategia']);
        Tag::create(['name' => 'Shooter']);
        Tag::create(['name' => 'Multijugador']);
    }
}
