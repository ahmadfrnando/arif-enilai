<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\SiswaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware(['auth', 'role:guru'])->group(function () {
    Route::get('/guru/dashboard', [GuruController::class, 'dashboard'])->name('guru.dashboard');
    Route::get('/guru/siswa', [GuruController::class, 'siswa'])->name('guru.siswa');
    Route::get('/guru/nilai-pengetahuan', [GuruController::class, 'nilaiPengetahuan'])->name('guru.nilai-pengetahuan');
    Route::get('/guru/nilai-keterampilan', [GuruController::class, 'nilaiKeterampilan'])->name('guru.nilai-keterampilan');
    Route::get('/guru/kelas', [GuruController::class, 'kelas'])->name('guru.kelas');
    Route::get('/guru/siswa/filter', [GuruController::class, 'filterSiswa'])->name('guru.filter-siswa');
    Route::get('/guru/siswa/cari', [GuruController::class, 'cariSiswa'])->name('guru.cari-siswa');
    Route::POST('/guru/nilai-pengetahuan/input', [GuruController::class, 'inputNilaiPengetahuan'])->name('guru.input-nilai-pengetahuan');
    Route::get('/guru/nilai-pengetahuan/filter', [GuruController::class, 'filterNilaiPengetahuan'])->name('guru.filter-nilai-pengetahuan');
    Route::get('/guru/nilai-pengetahuan/cari', [GuruController::class, 'cariNilaiPengetahuan'])->name('guru.cari-nilai-pengetahuan');
    Route::POST('/guru/nilai-keterampilan/input', [GuruController::class, 'inputNilaiKeterampilan'])->name('guru.input-nilai-keterampilan');
    Route::get('/guru/nilai-keterampilan/filter', [GuruController::class, 'filterNilaiKeterampilan'])->name('guru.filter-nilai-keterampilan');
    Route::get('/guru/nilai-keterampilan/cari', [GuruController::class, 'cariNilaiKeterampilan'])->name('guru.cari-nilai-keterampilan');
});

Route::middleware(['auth', 'role:siswa'])->group(function () {
    Route::get('/siswa/dashboard', function () {
        return view('siswa.dashboard');
    });
});

Route::middleware(['auth', 'role:kepsek'])->group(function () {
    Route::get('/kepala-sekolah/dashboard', function () {
        return view('kepala-sekolah.dashboard');
    });
});

