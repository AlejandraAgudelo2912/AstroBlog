<?php

namespace App\Livewire;

use App\Models\Post;
use App\Notifications\NewLikeNotification;
use Livewire\Component;

class LikeButton extends Component
{
    public Post $post;

    public bool $liked;

    public int $likes;

    public function mount(Post $post)
    {
        $this->post = $post;
        $this->likes = $post->likes;
        $this->liked = session()->has("liked_posts.{$post->id}");
    }

    public function toggleLike()
    {
        if (! auth()->check()) {
            return redirect()->route('login');
        }
        if ($this->liked) {
            $this->post->decrement('likes');
            session()->forget("liked_posts.{$this->post->id}");
            $this->liked = false;
        } else {
            $this->post->increment('likes');
            session()->put("liked_posts.{$this->post->id}", true);
            $this->liked = true;
        }

        if ($this->post->user_id !== auth()->id()) {
            $this->post->user->notify(new NewLikeNotification(auth()->user(), $this->post));
        }

        $this->likes = $this->post->likes;
    }

    public function render()
    {
        return view('livewire.like-button');
    }
}
