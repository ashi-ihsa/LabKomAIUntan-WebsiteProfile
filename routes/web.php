<?php
use Illuminate\Support\Facades\Route;

Route::get('/login', [App\Http\Controllers\DashboardController::class, 'home']);

Route::get('/', function () {
    return view('welcome');
});

Route::controller(App\Http\Controllers\UserController::class)->group(function(){
    Route::get('/login', 'login');
    Route::post('/doLogin', 'doLogin');
    Route::post('/doLogout', 'doLogout');
});

Route::get('/admin', function(){
    return view('admin.dashboard');
})->middleware(App\Http\Middleware\OnlyAdminMiddleware::class);

Route::get('/author', function(){
    return view('author.dashboard');
})->middleware(App\Http\Middleware\OnlyAuthorMiddleware::class);