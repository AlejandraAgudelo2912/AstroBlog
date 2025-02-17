<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Comment;
use App\Models\ObservationPoint;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RolesAndPermissionsSeeder::class);

        Post::factory(10)->create()->each(function ($post) {
            Comment::factory(5)->create([
                'post_id' => $post->id,
                'user_id' => User::factory(),
            ])->each(function ($comment) use ($post) {
                Comment::factory(3)->create([
                    'post_id' => $post->id,
                    'user_id' => User::factory(),
                    'parent_id' => $comment->id,
                ]);
            });
        });

        $user=User::factory()->create([
            'email' => 'paca@gmail.com',
            'password' => bcrypt('12345678'),

        ]);
        Category::factory(5)->create();
        Tag::factory(10)->create();
        ObservationPoint::factory(10)->create();

        $token = $user->createToken('User-token')->plainTextToken;

        dd($token);
    }
}
