<?php

use App\Http\Controllers\AlbumsController;
use App\Http\Controllers\PhotosController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => redirect()->route('dashboard'));

Route::middleware(['auth'])->prefix('dashboard')
    ->group(function () {
        Route::get('/users', static function () {
            return User::with('albums')->paginate(5);
        });
        Route::resource('/albums', AlbumsController::class);
        Route::get('/', [AlbumsController::class, 'index']);
        Route::get('/albums/{album}/images',
            [AlbumsController::class, 'getImages'])
            ->name('albums.images');

        Route::resource('photos', PhotosController::class);
    });

Route::get('/dashboard', static function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__ . '/auth.php';
