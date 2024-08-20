<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\V1\AlbumController;
use App\Http\Controllers\Api\V1\CategoryController;
use App\Http\Controllers\Api\V1\PhotoController;
use App\Http\Controllers\Api\V1\UserController;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::group(['middleware' => ['auth:sanctum']], static function () {
    Route::resource('users', UserController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('albums', AlbumController::class);
    Route::resource('photos', PhotoController::class);
    Route::post('logout', [AuthController::class, 'logout']);
});
