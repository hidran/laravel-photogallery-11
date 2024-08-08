<?php

use App\Http\Controllers\AlbumsController;
use App\Http\Controllers\PhotosController;
use App\Http\Controllers\ProfileController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/users', function () {
        return User::with('albums')->paginate(5);
    });
    Route::resource('/albums', AlbumsController::class);

Route::delete('/albums/{album}/delete', [AlbumsController::class, 'delete']);
Route::get('/dashboard', static function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile',
        [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile',
        [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile',
        [ProfileController::class, 'destroy'])->name('profile.destroy');
});
    Route::get('/', [AlbumsController::class, 'index']);
    Route::get('/albums/{album}/images', [AlbumsController::class, 'getImages'])
        ->name('albums.images');


    Route::resource('photos', PhotosController::class);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__ . '/auth.php';

