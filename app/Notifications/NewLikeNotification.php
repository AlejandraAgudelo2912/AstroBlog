<?php

namespace App\Notifications;

use App\Models\Post;
use App\Models\User;
use Illuminate\Notifications\Notification;

class NewLikeNotification extends Notification
{
    protected $user;

    protected $post;

    public function __construct(User $user, Post $post)
    {
        $this->user = $user;
        $this->post = $post;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'message' => $this->user->name.' le dio like a tu post: "'.$this->post->title.'"',
            'post_slug' => $this->post->slug,
            'user_id' => $this->user->id,
        ];
    }
}
