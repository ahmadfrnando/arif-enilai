<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\KepalaSekolahController;
use App\Http\Controllers\SiswaController;
use App\Models\DataSekolah;
use App\Models\Gallery;

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

Route::get('/', [GuestController::class, 'index'])->name('home');
Route::post('/kirim', [GuestController::class, 'contact'])->name('kirim.pesan');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'role:guru'])->group(function () {
    Route::get('/guru/dashboard', [GuruController::class, 'dashboard'])->name('guru.dashboard');

    Route::get('/guru/siswa', [GuruController::class, 'siswa'])->name('guru.siswa');
    Route::get('/guru/siswa/detail/{id}', [GuruController::class, 'detailSiswa'])->name('guru.siswa.show');
    Route::POST('/guru/siswa/lulus', [GuruController::class, 'siswaLulus'])->name('guru.siswa.lulus');

    Route::get('/guru/nilai-pengetahuan', [GuruController::class, 'nilaiPengetahuan'])->name('guru.nilai-pengetahuan');
    Route::POST('/guru/nilai-pengetahuan/input', [GuruController::class, 'inputNilaiPengetahuan'])->name('guru.input-nilai-pengetahuan');

    Route::get('/guru/nilai-keterampilan', [GuruController::class, 'nilaiKeterampilan'])->name('guru.nilai-keterampilan');
    Route::POST('/guru/nilai-keterampilan/input', [GuruController::class, 'inputNilaiKeterampilan'])->name('guru.input-nilai-keterampilan');

    Route::get('/guru/kelas', [GuruController::class, 'kelas'])->name('guru.kelas');

    Route::get('/guru/lulus-semester', [GuruController::class, 'lulusSemester'])->name('guru.lulus-semester');
    Route::post('/guru/lulus-semester', [GuruController::class, 'lulusSemesterStore'])->name('guru.lulus-semester.store');
    Route::get('/guru/lulus-semester/detail/{id_siswa}', [GuruController::class, 'lulusSemesterDetail'])->name('guru.lulus-semester-detail');
    Route::post('/guru/lulus-semester/input', [GuruController::class, 'inputLulusSemester'])->name('guru.lulus-semester.create');
    
    Route::get('/guru/ganti-password', [GuruController::class, 'gantiPassword'])->name('guru.ganti-password');
    Route::post('/guru/ganti-password', [GuruController::class, 'gantiPasswordUpdate'])->name('guru.ganti-password.update');
    Route::get('/guru/profile', [GuruController::class, 'profile'])->name('guru.profile');
    Route::post('/guru/profile/update', [GuruController::class, 'profileUpdate'])->name('guru.profile-update');
    Route::post('/guru/logout', [AuthController::class, 'logout'])->name('guru.logout');
});

Route::middleware(['auth', 'role:siswa'])->group(function () {
    Route::get('/siswa/dashboard', [SiswaController::class, 'dashboard'])->name('siswa.dashboard');

    Route::get('/siswa/nilai', [SiswaController::class, 'nilai'])->name('siswa.nilai');
    Route::post('/siswa/nilai', [SiswaController::class, 'nilai']);

    Route::get('/siswa/report', [SiswaController::class, 'report'])->name('siswa.report');
    Route::get('/siswa/download/{id}', [SiswaController::class, 'download'])->name('siswa.download');

    Route::get('/siswa/profile', [SiswaController::class, 'profile'])->name('siswa.profile');
    Route::post('/siswa/profile/update', [SiswaController::class, 'profileUpdate'])->name('siswa.profile-update');
    Route::get('/siswa/password', [SiswaController::class, 'password'])->name('siswa.password');
    Route::post('/siswa/password/update', [SiswaController::class, 'passwordUpdate'])->name('siswa.password.update');
    Route::post('/siswa/logout', [AuthController::class, 'logout'])->name('siswa.logout');

});

Route::middleware(['auth', 'role:kepsek'])->group(function () {
    Route::get('/kepsek/dashboard', [KepalaSekolahController::class, 'dashboard'])->name('kepsek.dashboard');

    Route::get('/kepsek/nilai-pengetahuan', [KepalaSekolahController::class, 'nilaiPengetahuan'])->name('kepsek.nilai-pengetahuan');
    Route::get('/kepsek/nilai-pengetahuan/filter', [KepalaSekolahController::class, 'filterNilaiPengetahuan'])->name('kepsek.filter-nilai-pengetahuan');

    Route::get('/kepsek/nilai-keterampilan', [KepalaSekolahController::class, 'nilaiKeterampilan'])->name('kepsek.nilai-keterampilan');
    // Route::post('/kepsek/nilai', [KepalaSekolahController::class, 'nilai']);
    
    Route::get('/kepsek/siswa', [KepalaSekolahController::class, 'siswa'])->name('kepsek.siswa');
    Route::post('/kepsek/siswa', [KepalaSekolahController::class, 'siswa']);

    Route::get('/kepsek/guru', [KepalaSekolahController::class, 'guru'])->name('kepsek.guru');
    Route::get('/kepsek/kelas', [KepalaSekolahController::class, 'kelas'])->name('kepsek.kelas');

    Route::get('/kepsek/report', [KepalaSekolahController::class, 'report'])->name('kepsek.report');

    Route::get('/kepsek/ganti-password', [KepalaSekolahController::class, 'gantiPassword'])->name('kepsek.ganti-password');
    Route::post('/kepsek/ganti-password/update', [KepalaSekolahController::class, 'gantiPasswordStore'])->name('kepsek.ganti-password.update');
    Route::post('/kepsek/logout', [AuthController::class, 'logout'])->name('kepsek.logout');
});
