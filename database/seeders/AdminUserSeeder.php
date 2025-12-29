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
            ['email' => 'admin@bepack.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'),
                'status' => 'active',
                'is_super_admin' => true,
                'email_verified_at' => now(),
            ]
        );

        // Ensure super_admin role exists (Shield should handle this but being explicit is good)
        $roleName = Utils::getSuperAdminName();
        $role = Role::firstOrCreate(['name' => $roleName, 'guard_name' => 'web']);
        
        $user->assignRole($role);
        
        $this->command->info("User 'admin@bepack.com' created with role {$roleName}");
    }
}
