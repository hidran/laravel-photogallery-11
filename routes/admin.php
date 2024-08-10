<?php


use App\Http\Controllers\Admin\AdminUsersController;

Route::prefix('admin')->middleware([
    'auth',
    'is_admin'
])->group(function () {
    Route::get('getUsers',
        [AdminUsersController::class, 'getUsers'])->name('admin.getUsers');

    Route::resource('users', AdminUsersController::class);
    Route::view('/', 'templates/admin')->name('admin');
    Route::get('/dashboard', static function () {
        return 'Admin DashBoard';
    });
});
