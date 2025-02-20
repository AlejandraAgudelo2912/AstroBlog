<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    public function run(): void
    {
        Post::all()->each(function ($post) {
            Comment::factory(5)->create([
                'post_id' => $post->id,
                'user_id' => User::inRandomOrder()->first()->id,
            ])->each(function ($comment) use ($post) {
                Comment::factory(3)->create([
                    'post_id' => $post->id,
                    'user_id' => User::inRandomOrder()->first()->id,
                    'parent_id' => $comment->id,
                ]);
            });
        });
    }
}
