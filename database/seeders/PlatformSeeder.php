<?php

namespace Database\Seeders;

use App\Models\Platform;
use Illuminate\Database\Seeder;

class PlatformSeeder extends Seeder
{
    public function run(): void
    {
        Platform::create(['name' => 'Steam']);
        Platform::create(['name' => 'PlayStation 5']);
        Platform::create(['name' => 'Xbox Series X']);
        Platform::create(['name' => 'Nintendo Switch']);
        Platform::create(['name' => 'Software']);
    }
}
