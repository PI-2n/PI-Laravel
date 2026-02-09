<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
            'password' => Hash::make('1234'),
        ]);

        User::factory()->create([
            'name' => 'Adrián',
            'last_name' => 'Gutiérrez',
            'username' => 'Adrián',
            'email' => 'gutionil@example.com',
            'role_id' => Role::where('name', 'admin')->first()->id,
            'password' => Hash::make('1234'),
        ]);

        User::factory()->create([
            'name' => 'Alejandro',
            'last_name' => 'Rico',
            'username' => 'Alejandro',
            'email' => 'alejandro@example.com',
            'role_id' => Role::where('name', 'admin')->first()->id,
            'password' => Hash::make('1234'),
        ]);

        // usuario moderador
        User::factory()->create([
            'name' => 'Moderator',
            'last_name' => 'moderador',
            'username' => 'moderador',
            'email' => 'moderador@example.com',
            'role_id' => Role::where('name', 'moderator')->first()->id,
            'password' => Hash::make('1234'),
        ]);

        // usuario cliente
        User::factory()->create([
            'name' => 'Customer',
            'last_name' => 'cliente',
            'username' => 'cliente',
            'email' => 'cliente@example.com',
            'role_id' => Role::where('name', 'customer')->first()->id,
            'password' => Hash::make('1234'),
        ]);
    }
}
