<?php



Route::prefix('admin')->middleware([
    'auth',
    'is_admin'
])->group(function () {
    Route::view('/', 'templates/admin')->name('admin');


    Route::get('/dashboard', static function () {
        return 'Admin DashBoard';
    });
});
