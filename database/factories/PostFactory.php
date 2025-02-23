<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition(): array
    {
        $storagePath = storage_path('app/public/posts');

        $imagePath = fake()->image($storagePath, 640, 480, null, false);

        return [
            'user_id'=>User::factory(),
            'category_id'=>Category::factory(),
            'title' => $title = $this->faker->sentence(),
            'body' => $this->faker->paragraph(),
            'slug' => Str::slug($title),
            'status' => $this->faker->randomElement(['published', 'draft', 'archived']),
            'visibility' => $this->faker->randomElement(['public', 'private']),
            'likes' => $this->faker->numberBetween(0, 100),
            'cover_image' =>'posts/' . basename($imagePath),
            'published_at' => $this->faker->dateTimeBetween('now', '+1 year'),
        ];
    }
}
