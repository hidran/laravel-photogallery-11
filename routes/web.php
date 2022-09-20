<?php

use App\Http\Controllers\AlbumsController;
use App\Http\Controllers\ProfileController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', static function () {
    return view('welcome');
});
Route::get('/users', static function () {
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

require __DIR__ . '/auth.php';

Route::get('usersnoalbums', function () {
    $usersnoalbum = DB::table('users  as u')
        ->leftJoin('albums as a', 'u.id', 'a.user_id')
        ->select('u.id', 'email', 'name', 'album_name')->
        whereRaw('album_name is null')
        ->get();
    $usersnoalbum = DB::table('users  as u')
        ->select('u.id', 'email', 'name')->
        whereRaw(' EXISTS (SELECT user_id from albums where user_id= u.id)')
        ->get();
    return $usersnoalbum;
});
