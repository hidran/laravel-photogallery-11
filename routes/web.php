<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AlbumsController, CategoryController, GalleryController, PhotosController};

Route::get('/', function () {
    return redirect()->route('gallery.index');
});

Route::middleware(['auth'])->prefix('dashboard')->group(function () {

    Route::resource('/albums', AlbumsController::class)->middleware('auth');
    Route::get('/albums/{album}/images', [AlbumsController::class,'getImages'])->name('albums.images')
        ->middleware('can:view,album');
    Route::resource('photos', PhotosController::class);
});



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// gallery
Route::group(['prefix' => 'gallery'], function (){
    Route::get('/',  [GalleryController::class, 'index'])->name('gallery.index');
    Route::get('albums', [GalleryController::class, 'index']);
    Route::get('album/{album}/images',  [GalleryController::class, 'showAlbumImages'])->name('gallery.album.images');
    Route::get('categories/{category}/albums',  [GalleryController::class, 'showCategoryAlbums'])->name('gallery.categories.albums');
});

Route::resource('categories', CategoryController::class);
require __DIR__.'/auth.php';
