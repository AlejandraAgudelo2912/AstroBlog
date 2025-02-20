<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        $roles = ['god','admin', 'user'];

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        $permissions = [
            'create posts',
            'edit posts',
            'delete posts',
            'manage roles',
            'asign roles',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $godRole = Role::where('name', 'god')->first();
        $godRole->syncPermissions(Permission::all());

        $adminRole = Role::where('name', 'admin')->first();
        $adminRole->syncPermissions([
            'create posts', 'edit posts', 'delete posts'
        ]);

        $userRole = Role::where('name', 'user')->first();
        $userRole->syncPermissions(['create posts', 'edit posts', 'delete posts']);

        $testUser = User::updateOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => bcrypt('12345678'),
            ]
        );

        $testUser->assignRole('god');
    }
}
