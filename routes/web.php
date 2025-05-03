<?php
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [App\Http\Controllers\DashboardController::class, 'home']);
Route::controller(App\Http\Controllers\UserController::class)->group(function(){
    Route::get('/login', 'login')->name('login');
    Route::post('/doLogin', 'doLogin')->name('doLogin');
    Route::post('/doLogout', 'doLogout')->name('doLogout');
});

Route::controller(App\Http\Controllers\TentangController::class)
    ->middleware(App\Http\Middleware\OnlyAdminMiddleware::class)->group(function(){
    Route::get('/admin/tentang','index')->name('admin.tentang.index');
    Route::post('admin/tentang/save', 'saveTentang')->name('admin.tentang.save');
});

Route::controller(App\Http\Controllers\AuthorController::class)
    ->middleware(App\Http\Middleware\OnlyAdminMiddleware::class)->group(function(){
    Route::get('/admin/author', 'index')->name('admin.author.index');
    Route::post('/admin/author/create', 'createAuthor')->name('admin.author.create');
    Route::post('/admin/author/{id}/delete', 'deleteAuthor')->name('admin.author.delete');
    Route::get('/admin/author/{id}', 'editAuthorById')->name('admin.author.edit');
    Route::post('/admin/author/{id}/update', 'updateAuthor')->name('admin.author.update');
});

Route::get('/author', function(){
    return view('author.dashboardAuthor');
})->middleware(App\Http\Middleware\OnlyAuthorMiddleware::class);