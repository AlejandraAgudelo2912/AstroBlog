<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        Post::factory(10)->create([
            'user_id' => User::inRandomOrder()->first()->id,
        ]);
    }
}
