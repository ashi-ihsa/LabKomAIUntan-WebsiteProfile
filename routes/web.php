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

Route::controller(App\Http\Controllers\TagController::class)
    ->middleware(App\Http\Middleware\OnlyAdminMiddleware::class)->group(function(){
    Route::get('/admin/tag', 'index')->name('admin.tag.index');
    Route::post('/admin/tag/create', 'createTag')->name('admin.tag.create');
    Route::post('/admin/tag/{id}/update', 'editTag')->name('admin.tag.edit');
    Route::post('/admin/tag/{id}/delete', 'deletetag')->name('admin.tag.delete');
});

Route::controller(App\Http\Controllers\DosenController::class)
    ->middleware(App\Http\Middleware\OnlyAdminMiddleware::class)->group(function(){
    Route::get('/admin/dosen', 'index')->name('admin.dosen.index');
    Route::post('/admin/dosen/create', 'createDosen')->name('admin.dosen.create');
    Route::post('/admin/dosen/{id}/delete', 'deleteDosen')->name('admin.dosen.delete');
    Route::get('/admin/dosen/{id}', 'editDosenById')->name('admin.dosen.edit');
    Route::post('/admin/dosen/{id}/update', 'updateDosen')->name('admin.dosen.update');
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