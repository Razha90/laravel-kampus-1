<?php

use App\Http\Controllers\AdminAkses;
use App\Http\Controllers\AdminAksesDosen;
use App\Http\Controllers\AdminAksesJurusan;
use App\Http\Controllers\AdminAksesMahasiswa;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PageKampusController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckRole;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/denied-access', function () {
    return view('Error.HakAkses');
})->name('access-denied');

Route::middleware(['auth', 'checkrole:Admin'])->group(function () {
    Route::get('/mahasiswa', [PageKampusController::class, 'pageMahasiswa'])->name('pageMahasiswa');
    Route::get('/api/data-mahasiswa', [PageKampusController::class, 'data_mahasiswa'])->name('data-mahasiswa');
    Route::get('/api/data-dosen', [PageKampusController::class, 'data_dosen']);

    Route::get('/dosen', [PageKampusController::class, 'pageDosen']);

    Route::resource('/admin/mahasiswa', AdminAksesMahasiswa::class);
    Route::resource('/admin/jurusan', AdminAksesJurusan::class);
    Route::resource('/admin/dosen', AdminAksesDosen::class);

    Route::get('/dashboard', [Dashboard::class, 'home']);
    Route::get('/dashboard/mahasiswa', [Dashboard::class, 'createMahasiswa']);
    Route::get('/dashboard/dosen', [Dashboard::class, 'createDosen']);
    Route::get('/dashboard/jurusan', [Dashboard::class, 'createJurusan']);

});

Route::get('/profile',[LoginController::class, 'profile'])->middleware('auth');
Route::get('/login',[LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login',[LoginController::class, 'authenticate']);

Route::post('/logout',[LoginController::class, 'logout']);

Route::get('/register',[RegisterController::class, 'index'])->name('register');
Route::post('/register',[RegisterController::class, 'store']);


Route::get('/jurusan', [PageKampusController::class, 'pageJurusan']);
Route::get('/api/data-jurusan', [PageKampusController::class, 'data_jurusan']);
