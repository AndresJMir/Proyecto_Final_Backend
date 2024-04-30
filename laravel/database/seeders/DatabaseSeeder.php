<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            RoleSeeder::class,
        ]);

        // Crear usuario administrador
        User::create([
            'name' => 'administrador',
            'email' => 'admin@admin.net',
            'password' => Hash::make('123'),
            'role_id' => 1,
        ]);
    }
}
