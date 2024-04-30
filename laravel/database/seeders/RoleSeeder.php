<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
    // Crear un nuevo usuario con una dirección de correo electrónico única
    // $user = User::factory()->create();

        // Crear roles
        Role::create(['name' => 'ADMIN']);
        Role::create(['name' => 'EDITOR']);
        Role::create(['name' => 'USUARIO']);
    }
}
