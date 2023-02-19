<?php

use App\Http\Controllers\AlbumsController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\PhotosController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => redirect()->route('gallery.index'));

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

// gallery
Route::group(['prefix' => 'gallery'], function () {
    Route::get('/', [GalleryController::class, 'index'])->name('gallery.index');
    Route::get('albums', [GalleryController::class, 'index']);
    Route::get('album/{album}/images', [GalleryController::class, 'showAlbumImages'])->name('gallery.album.images');
});
require __DIR__ . '/auth.php';
