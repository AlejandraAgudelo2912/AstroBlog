<?php

namespace App\Listeners;

use App\Events\NewCommentAddedEvent;
use App\Jobs\SendNotificationJob;

class NotifyPostAuthorOfCommentListener
{
    public function __construct() {}

    public function handle(NewCommentAddedEvent $event): void
    {
        $post = $event->comment->post;
        $author = $post->user;

        if ($author && $author->id !== $event->comment->user_id) {
            SendNotificationJob::dispatchAfterResponse($author, $event->comment);
        }
    }
}
