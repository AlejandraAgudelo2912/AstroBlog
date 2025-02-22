<?php

use App\Http\Controllers\PdfController;
use App\Http\Controllers\User\UserCategoryController;
use App\Http\Controllers\User\UserCommentController;
use App\Http\Controllers\User\UserNotificationController;
use App\Http\Controllers\User\UserObservationPointController;
use App\Http\Controllers\User\UserPostController;
use App\Http\Controllers\User\UserTagController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->prefix('user')->name('user.')->group(function () {
    Route::resource('posts', UserPostController::class);
    Route::resource('posts.comments', UserCommentController::class);
    Route::resource('categories', UserCategoryController::class)->only(['index', 'show']);
    Route::resource('tags', UserTagController::class)->only(['index', 'show']);
    Route::get('map', [UserObservationPointController::class, 'index'])->name('map.index');

    Route::get('/my-posts', [UserPostController::class, 'myPosts'])->name('posts.my');
    Route::get('posts/{post}/comments/{comment}/reply', [UserCommentController::class, 'replied'])
        ->name('posts.comments.replied');
    Route::post('posts/{post}/comments/{comment}/reply', [UserCommentController::class, 'reply'])
        ->name('posts.comments.reply');

    Route::get('/post/{post}/pdf', [PdfController::class, 'generatePostPDF'])->name('post.pdf');

    Route::get('/notifications', [UserNotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{id}/mark-as-read', [UserNotificationController::class, 'markAsRead'])->name('notifications.markAsRead');

});
