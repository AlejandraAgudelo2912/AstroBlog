<?php

namespace App\Jobs;

use App\Models\User;
use App\Notifications\NewCommentNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SendNotificationJob implements ShouldQueue
{
    use Dispatchable, Queueable, SerializesModels;

    protected $user;
    protected $comment;

    public function __construct(User $user, $comment)
    {
        $this->user = $user;
        $this->comment = $comment;
    }
    public function handle()
    {
        $this->user->notify(new NewCommentNotification($this->comment));
    }
}
