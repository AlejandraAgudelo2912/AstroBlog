<?php

use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminCommentController;
use App\Http\Controllers\Admin\AdminObserverPointController;
use App\Http\Controllers\Admin\AdminPostController;
use App\Http\Controllers\Admin\AdminTagController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\PdfController;
use Illuminate\Support\Facades\Route;

Route::get('admin/posts/list', [AdminPostController::class, 'list'])->name('admin.posts.list');
Route::get('admin/users/list', [AdminUserController::class, 'list'])->name('admin.users.list');

Route::middleware(['auth', 'role:admin|god'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('posts', AdminPostController::class);
    Route::resource('posts.comments', AdminCommentController::class);
    Route::resource('categories', AdminCategoryController::class);
    Route::resource('tags', AdminTagController::class);
    Route::get('map', [AdminObserverPointController::class, 'index'])->name('map.index');
    Route::post('map', [AdminObserverPointController::class, 'store'])->name('map.store');

    Route::get('/my-posts', [AdminPostController::class, 'myPosts'])->name('posts.my');
    Route::get('posts/{post}/comments/{comment}/reply', [AdminCommentController::class, 'replied'])
        ->name('posts.comments.replied');
    Route::post('posts/{post}/comments/{comment}/reply', [AdminCommentController::class, 'reply'])
        ->name('posts.comments.reply');

    Route::get('users/pdf', [PdfController::class, 'generateUsersReport'])->name('users.pdf');

});
