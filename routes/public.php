<?php

use App\Http\Controllers\Public\PublicCategoryController;
use App\Http\Controllers\Public\PublicCommentController;
use App\Http\Controllers\Public\PublicObservationPointController;
use App\Http\Controllers\Public\PublicPostController;
use App\Http\Controllers\Public\PublicTagController;

Route::get('/posts', [PublicPostController::class, 'index'])->name('posts.index');
Route::get('/posts/{post}', [PublicPostController::class, 'show'])->name('posts.show');
Route::get('/categories', [PublicCategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{category}', [PublicCategoryController::class, 'show'])->name('categories.show');
Route::get('/tags', [PublicTagController::class, 'index'])->name('tags.index');
Route::get('/tags/{tag}', [PublicTagController::class, 'show'])->name('tags.show');
Route::get('/posts/{post}/comments', [PublicCommentController::class, 'index'])->name('posts.comments.index');
Route::get('/posts/{post}/comments/{comment}', [PublicCommentController::class, 'show'])->name('posts.comments.show');
Route::get('/map', [PublicObservationPointController::class, 'index'])->name('map.index');
