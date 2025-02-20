<?php

namespace App\Observers;

use App\Events\NewCommentAddedEvent;
use App\Models\Comment;

class CommentObserver
{
    public function created(Comment $comment)
    {
        event(new NewCommentAddedEvent($comment));
    }
}
