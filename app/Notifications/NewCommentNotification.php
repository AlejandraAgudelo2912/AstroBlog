<?php

namespace App\Notifications;

use App\Models\Comment;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewCommentNotification extends Notification
{
    use Queueable;

    public $comment;


    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }


    public function via($notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Nuevo comentario en tu post')
            ->greeting('¡Hola ' . $notifiable->name . '!')
            ->line('Un usuario ha comentado en tu post: "' . $this->comment->post->title . '"')
            ->action('Ver comentario', url('/posts/' . $this->comment->post->id))
            ->line('¡Gracias por participar en la comunidad!');
    }

    public function toArray($notifiable): array
    {
        return [
            'message' => 'Un usuario ha comentado en tu post: "' . $this->comment->post->title . '"',
            'post_id' => $this->comment->post->id,
            'comment_id' => $this->comment->id,
        ];
    }
}
