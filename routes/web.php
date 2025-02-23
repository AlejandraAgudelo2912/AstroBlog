<?php

use App\Http\Controllers\EonetController;
use App\Http\Controllers\NasaController;
use App\Http\Controllers\PageHomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserProfileController;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/public.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/user.php';

Route::get('/',[PageHomeController::class,'index'])->name('page-home.index');

Route::get('/nasa/picture', [NasaController::class, 'showPicture'])->name('nasa.picture');
Route::get('/nasa/asteroids', [NasaController::class, 'showAsteroids'])->name('nasa.asteroids');
Route::get('/events', [EonetController::class, 'index'])->name('eonet.index');
Route::get('/events/{id}', [EonetController::class, 'show'])->name('eonet.show');
Route::get('/user/{user}', [UserProfileController::class, 'show'])->name('user.profile');
Route::get('/user/{user}/posts', [UserProfileController::class, 'byPosts'])->name('user.byPosts');

Route::middleware(['auth', 'role:god'])->group(function () {
    Route::resource('users', UserController::class)->except(['create', 'store']);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return redirect('/');
    })->middleware(['auth', 'verified'])->name('dashboard');
});
