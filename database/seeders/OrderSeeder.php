<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();

        foreach ($users as $user) {
            // Cada usuario tendrá entre 0 y 2 órdenes
            $ordersCount = rand(0, 2);
            for ($i = 0; $i < $ordersCount; $i++) {
                Order::factory()->create([
                    'status' => 'completed',
                ]);
            }
        }
    }
}
