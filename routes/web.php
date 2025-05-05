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

Route::controller(App\Http\Controllers\PublikasiController::class)
    ->middleware(App\Http\Middleware\OnlyAdminMiddleware::class)->group(function(){
    Route::get('/admin/publikasi', 'index')->name('admin.publikasi.index');
    Route::post('/admin/publikasi/create', 'createPublikasi')->name('admin.publikasi.create');
    Route::post('/admin/publikasi/{id}/delete', 'deletePublikasi')->name('admin.publikasi.delete');
    Route::get('/admin/publikasi/{id}', 'editPublikasiById')->name('admin.publikasi.edit');
    Route::post('/admin/publikasi/{id}/update', 'updatePublikasi')->name('admin.publikasi.update');
    Route::post('/admin/publikasi/{id}/publish', 'setPublishStatus')->name('admin.publikasi.publish');
    Route::post('/admin/publikasi/{id}/highlight','setHighlightStatus')->name('admin.publikasi.highlight');
});

Route::controller(App\Http\Controllers\KerjasamaController::class)
    ->middleware(App\Http\Middleware\OnlyAdminMiddleware::class)->group(function(){
    Route::get('/admin/kerjasama', 'index')->name('admin.kerjasama.index');
    Route::post('/admin/kerjasama/create', 'createKerjasama')->name('admin.kerjasama.create');
    Route::post('/admin/kerjasama/{id}/delete', 'deleteKerjasama')->name('admin.kerjasama.delete');
    Route::get('/admin/kerjasama/{id}', 'editKerjasamaById')->name('admin.kerjasama.edit');
    Route::post('/admin/kerjasama/{id}/update', 'updateKerjasama')->name('admin.kerjasama.update');
    Route::post('/admin/kerjasama/{id}/publish', 'setPublishStatus')->name('admin.kerjasama.publish');
});

Route::controller(App\Http\Controllers\ArtikelController::class)
    ->middleware(App\Http\Middleware\OnlyAdminMiddleware::class)->group(function(){
    Route::get('/admin/artikel', 'index')->name('admin.artikel.index');
    Route::post('/admin/artikel/create', 'createArtikel')->name('admin.artikel.create');
    Route::post('/admin/artikel/{id}/delete', 'deleteArtikel')->name('admin.artikel.delete');
    Route::get('/admin/artikel/{id}', 'editArtikelById')->name('admin.artikel.edit');
    Route::post('/admin/artikel/{id}/update', 'updateArtikel')->name('admin.artikel.update');
    Route::post('/admin/artikel/{id}/publish', 'setPublishStatus')->name('admin.artikel.publish');
    Route::post('/admin/artikel/{id}/highlight','setHighlightStatus')->name('admin.artikel.highlight');
});

Route::controller(App\Http\Controllers\AgendaController::class)
    ->middleware(App\Http\Middleware\OnlyAdminMiddleware::class)->group(function(){
    Route::get('/admin/agenda', 'index')->name('admin.agenda.index');
    Route::post('/admin/agenda/create', 'createAgenda')->name('admin.agenda.create');
    Route::post('/admin/agenda/{id}/delete', 'deleteAgenda')->name('admin.agenda.delete');
    Route::get('/admin/agenda/{id}', 'editAgendaById')->name('admin.agenda.edit');
    Route::post('/admin/agenda/{id}/update', 'updateAgenda')->name('admin.agenda.update');
    Route::post('/admin/agenda/{id}/lewat', 'setSudahLewatStatus')->name('admin.agenda.lewat');
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