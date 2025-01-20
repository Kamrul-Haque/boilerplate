<?php

namespace Database\Seeders;

use App\Enums\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Super Admin',
            'email' => 'super@admin.com',
            'password' => bcrypt('Test@2024'),
            'role' => Role::SUPER_ADMIN->value,
        ]);

        User::create([
            'name' => 'Mr. Admin',
            'email' => 'admin@email.com',
            'password' => bcrypt('Test@2024'),
            'role' => Role::ADMIN->value,
        ]);

        User::create([
            'name' => 'Mr. User',
            'email' => 'user@email.com',
            'password' => bcrypt('Test@2024'),
            'role' => Role::USER->value,
        ]);
    }
}
