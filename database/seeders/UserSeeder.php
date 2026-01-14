<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Usuario administrador
        User::factory()->create([
            'name' => 'Admin',
            'last_name' => 'User',
            'username' => 'admin',
            'email' => 'admin@example.com',
            'role_id' => Role::where('name', 'admin')->first()->id,
        ]);

        // Algunos usuarios de prueba
        User::factory(5)->create();
    }
}
