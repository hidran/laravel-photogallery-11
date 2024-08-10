<?php

use App\Events\NewAlbumCreated;
use App\Http\Controllers\AlbumsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\PhotosController;
use App\Mail\TestEmail;
use App\Models\Album;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('gallery.index');
});

Route::middleware(['auth'])->prefix('dashboard')->group(function () {
    Route::resource('/albums', AlbumsController::class)->middleware('auth');
    Route::get('/albums/{album}/images',
        [AlbumsController::class, 'getImages'])->name('albums.images')
        ->middleware('can:view,album');
    Route::resource('photos', PhotosController::class);
    Route::resource('categories', CategoryController::class);
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// gallery
Route::group(['prefix' => 'gallery'], function () {
    Route::get('/', [GalleryController::class, 'index'])->name('gallery.index');
    Route::get('albums', [GalleryController::class, 'index']);
    Route::get('album/{album}/images', [
        GalleryController::class,
        'showAlbumImages'
    ])->name('gallery.album.images');
    Route::get('categories/{category}/albums', [
        GalleryController::class,
        'showCategoryAlbums'
    ])->name('gallery.categories.albums');
});


require __DIR__ . '/auth.php';
//Route::prefix('admin')->middleware([])->group(base_path('routes/admin.php'));


// mail
Route::get('testMail', function () {
    Mail::to('hidran@gmail.com')->send(new TestEmail(null));
});
//
// event
Route::get('testEvent', function () {
    $album = Album::first();
    event(new NewAlbumCreated($album));
});
