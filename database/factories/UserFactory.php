<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        // Obtener todos los roles existentes
        $roles = Role::all();

        // Si no hay roles, asignar null (o podrías lanzar excepción)
        $roleId = $roles->isNotEmpty() ? $roles->random()->id : null;

        return [
            'name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'username' => $this->faker->unique()->userName,
            'email' => $this->faker->unique()->safeEmail,
            'password' => Hash::make('password'), // contraseña por defecto para pruebas
            'role_id' => $roleId,
        ];
    }
}
