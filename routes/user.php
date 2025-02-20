<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserPostController;
use App\Http\Controllers\User\UserCommentController;
use App\Http\Controllers\User\UserCategoryController;
use App\Http\Controllers\User\UserTagController;
use App\Http\Controllers\User\UserObserverPointController;

Route::middleware(['auth'])->prefix('user')->name('user.')->group(function () {
    Route::resource('posts', UserPostController::class);
    Route::resource('post.comments', UserCommentController::class);
    Route::resource('categories', UserCategoryController::class)->only(['index', 'show']);
    Route::resource('tags', UserTagController::class)->only(['index', 'show']);
    Route::get('map', [UserObserverPointController::class, 'index'])->name('map.index');

    Route::get('/my-posts', [UserPostController::class, 'myPosts'])->name('user.posts.my');
    Route::get('posts/{post}/comments/{comment}/reply', [UserCommentController::class, 'replied'])
        ->name('posts.comments.replied');
    Route::post('posts/{post}/comments/{comment}/reply', [UserCommentController::class, 'reply'])
        ->name('posts.comments.reply');
});
