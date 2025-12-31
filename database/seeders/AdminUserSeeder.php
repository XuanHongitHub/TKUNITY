<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use BezhanSalleh\FilamentShield\Support\Utils;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::firstOrCreate(
            ['email' => 'admin@tkunity.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'),
                'status' => 'active',
                'is_super_admin' => true,
                'email_verified_at' => now(),
            ]
        );

        $roleName = Utils::getSuperAdminName();
        $role = Role::firstOrCreate(['name' => $roleName, 'guard_name' => 'web']);

        $user->assignRole($role);

        $this->command->info("User 'admin@tkunity.com' created with role {$roleName}");
    }
}
