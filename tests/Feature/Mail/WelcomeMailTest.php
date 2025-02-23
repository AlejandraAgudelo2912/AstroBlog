<?php

use App\Mail\WelcomeMail;
use App\Models\User;

it('sends a welcome mail to new users', function () {
    // Arrange
    Mail::fake();
    $user = User::factory()->create(['email' => 'user'.time().'@example.com']);

    // Act
    Mail::to($user->email)->send(new WelcomeMail($user));

    // Assert
    Mail::assertSent(WelcomeMail::class, function ($mail) use ($user) {
        return $mail->hasTo($user->email) && $mail->user->id === $user->id;
    });
});
