<?php

use App\Http\Controllers\AlbumsController;
use App\Http\Controllers\ProfileController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/users', function () {
    return User::with('albums')->paginate(5);
});
Route::get('/albums', [AlbumsController::class, 'index']);

Route::get('/dashboard', function () {
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

require __DIR__ . '/auth.php';
