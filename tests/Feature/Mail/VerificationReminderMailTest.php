<?php

use App\Mail\VerificationReminderMail;
use App\Models\User;

it('sends a verification reminder email to a user', function () {
    // Arrange
    Mail::fake();
    $user = User::factory()->create(['email' => 'user'.time().'@example.com']);

    // Act
    Mail::to($user->email)->send(new VerificationReminderMail($user));

    // Assert
    Mail::assertSent(VerificationReminderMail::class, function ($mail) use ($user) {
        return $mail->hasTo($user->email) && $mail->user->id === $user->id;
    });
});
