<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Llamar a los seeders en el orden correcto según dependencias

        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            TagSeeder::class,
            PlatformSeeder::class,
            ProductSeeder::class,
            CommentSeeder::class,
            //ProductRelationSeeder::class,
            ShoppingCartSeeder::class,
            ShoppingCartItemSeeder::class,
            OrderSeeder::class,
            OrderItemSeeder::class,
            CreditCardSeeder::class,
        ]);
    }
}
