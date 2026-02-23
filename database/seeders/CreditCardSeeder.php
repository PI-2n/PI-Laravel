<?php

namespace Database\Seeders;

use App\Models\CreditCard;
use App\Models\User;
use Illuminate\Database\Seeder;

class CreditCardSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();

        foreach ($users as $user) {
            // Cada usuario tendrá 1-2 tarjetas guardadas
            $cardsCount = rand(1, 2);
            
            for ($i = 0; $i < $cardsCount; $i++) {
                CreditCard::create([
                    'user_id' => $user->id,
                    'card_number' => '411111111111111' . rand(1, 9),
                    'card_holder_name' => strtoupper($user->name . ' ' . $user->last_name),
                    'expiration_date' => rand(1, 12) . '/' . (date('y') + rand(1, 5)),
                    'cvv' => rand(100, 999),
                ]);
            }
        }
    }
}