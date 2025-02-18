<?php

namespace App\Console\Commands;

use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Console\Command;

class FeatureMostLikedPostsCommand extends Command
{
    protected $signature = 'posts:feature-most-liked';
    protected $description = 'Marcar como destacados los posts con más likes en la última semana';

    public function handle()
    {
        $this->info('Marcando los posts más likeados como destacados...');

        $lastWeek = Carbon::now()->subWeek();

        $topPosts = Post::where('created_at', '>=', $lastWeek)
            ->orderByDesc('likes')
            ->limit(5)
            ->get();

        foreach ($topPosts as $post) {
            $post->update(['featured' => true]);
        }

        $this->info("Se han destacado " . count($topPosts) . " posts.");
    }
}
