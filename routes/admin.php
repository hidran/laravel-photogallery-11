<?php


Route::get('/', static function () {
    return 'Hello Admin';
});

Route::get('/dashboard', static function () {
    return 'Admin DashBoard';
});
