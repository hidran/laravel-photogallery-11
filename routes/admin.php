<?php


Route::prefix('admin')->middleware([
    'auth',
    'is_admin'
])->group(function () {
    Route::get('/', static function () {
        return 'Hello Admin';
    });

    Route::get('/dashboard', static function () {
        return 'Admin DashBoard';
    });
});
