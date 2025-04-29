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

Route::controller(App\Http\Controllers\AuthorController::class)
    ->middleware(App\Http\Middleware\OnlyAdminMiddleware::class)->group(function(){
    Route::get('/admin/author', 'index');
    Route::post('/admin/author/create', 'createAuthor');
    Route::post('/admin/author/{id}/delete', 'deleteAuthor');
    Route::get('/admin/author/{id}', 'editAuthorById');
    Route::post('/admin/author/{id}/update', 'updateAuthor');
});


Route::get('/author', function(){
    return view('author.dashboardAuthor');
})->middleware(App\Http\Middleware\OnlyAuthorMiddleware::class);