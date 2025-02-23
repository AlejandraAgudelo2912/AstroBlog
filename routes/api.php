<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\ObservationPointController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\TagController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'force.json'])->name('api.')->group(function () {
    Route::get('posts', [PostController::class, 'index'])->name('posts.index');
    Route::post('posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('posts/{post:id}', [PostController::class, 'show'])->name('posts.show');
    Route::put('posts/{post:id}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('posts/{post:id}', [PostController::class, 'destroy'])->name('posts.destroy');

    Route::get('posts/{post:id}/comments', [CommentController::class, 'index'])->name('posts.comments.index');
    Route::post('posts/{post:id}/comments', [CommentController::class, 'store'])->name('posts.comments.store');
    Route::get('posts/{post:id}/comments/{comment:id}', [CommentController::class, 'show'])->name('posts.comments.show');
    Route::put('posts/{post:id}/comments/{comment:id}', [CommentController::class, 'update'])->name('posts.comments.update');
    Route::delete('posts/{post:id}/comments/{comment:id}', [CommentController::class, 'destroy'])->name('posts.comments.destroy');

    Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::post('categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('categories/{category:id}', [CategoryController::class, 'show'])->name('categories.show');
    Route::put('categories/{category:id}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('categories/{category:id}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    Route::get('tags', [TagController::class, 'index'])->name('tags.index');
    Route::post('tags', [TagController::class, 'store'])->name('tags.store');
    Route::get('tags/{tag:id}', [TagController::class, 'show'])->name('tags.show');
    Route::put('tags/{tag:id}', [TagController::class, 'update'])->name('tags.update');
    Route::delete('tags/{tag:id}', [TagController::class, 'destroy'])->name('tags.destroy');

    Route::get('/map', [ObservationPointController::class, 'index'])->name('map.index');
    Route::post('/map', [ObservationPointController::class, 'store'])->name('map.store');
    Route::get('/map/{observationPoint:id}', [ObservationPointController::class, 'show'])->name('map.show');
    Route::put('/map/{observationPoint:id}', [ObservationPointController::class, 'update'])->name('map.update');
    Route::delete('/map/{observationPoint:id}', [ObservationPointController::class, 'destroy'])->name('map.destroy');

});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
