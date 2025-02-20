<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class UserNotificationController extends Controller
{
    public function index()
    {
        $notifications = auth()->user()->notifications;
        return view('user.notifications.index', compact('notifications'));
    }

    public function markAsRead($id)
    {
        $notification = auth()->user()->notifications()->find($id);

        if ($notification) {
            $notification->markAsRead();
        }

        return redirect()->back();
    }
}
