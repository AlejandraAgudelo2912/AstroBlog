<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory(10)->create();

        $admin= User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678'),
        ]);

        $admin->assignRole('admin');

        $user = User::create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
        $user->assignRole('user');

        $adminAbilities = ['*'];

        $userAbilities = [
            'view-posts',
            'create-posts',
            'edit-own-posts',
            'delete-own-posts',
            'view-categories',
            'view-tags',
            'view-observation-points',
            'create-observation-points',
        ];

        $adminToken = $admin->createToken('Admin Token', $adminAbilities)->plainTextToken;

        $userToken = $user->createToken('User Token', $userAbilities)->plainTextToken;

        $this->command->info("Admin Token: $adminToken");
        $this->command->info("User Token: $userToken");

        file_put_contents(storage_path('app/tokens.txt'), "Admin Token: $adminToken\nUser Token: $userToken\n");
    }
}
