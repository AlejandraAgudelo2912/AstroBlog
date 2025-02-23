<?php

use App\Mail\InactiveUserNotificationMail;
use App\Models\User;

it('sends an inactive user notification email', function () {
    // Arrange
    Mail::fake();
    $user = User::factory()->create(['email' => 'user'.time().'@example.com']);

    // Act
    Mail::to($user->email)->send(new InactiveUserNotificationMail);

    // Assert
    Mail::assertSent(InactiveUserNotificationMail::class, function ($mail) use ($user) {
        return $mail->hasTo($user->email);
    });
});
