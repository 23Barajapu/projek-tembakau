<?php

use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\Api\LahanController as ApiLahanController;
use App\Http\Controllers\Api\TahapanController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\HasilPanenController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\KirimPesanController;
use App\Http\Controllers\LahanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PanenController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TahapanController as ControllersTahapanController;
use App\Http\Controllers\TokenWebController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Rute untuk login dan register tidak memerlukan middleware 'auth'
Route::get('/login', [UserController::class, 'index'])->name('login');
Route::post('/login', [UserController::class, 'login']);
Route::get('/register', [RegisterController::class, 'register'])->name('register');
Route::post('/akun', [RegisterController::class, 'akun'])->name('akun');

//reset password
Route::get('/forgot-password', [PasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [PasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [PasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [PasswordController::class, 'reset'])->name('password.update');
Route::post('tokenweb', TokenWebController::class);
Route::post('/kirim-pesan', [KirimPesanController::class, 'store'])->name('kirim_pesan.pesan');

// Rute di bawah middleware 'auth' hanya untuk yang sudah login
Route::middleware(['auth'])->group(function () {

    Route::get('/', [DashboardController::class, 'index']);
    Route::post('/logout', [DashboardController::class, 'logout'])->name('logout');

    //Profile
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/jadwal', [JadwalController::class, 'index'])->name('jadwal');
    Route::get('/monitoring', [JadwalController::class, 'monitoring'])->name('monitoring');
    Route::get('/detail-monitoring/{id}', [TahapanController::class, 'index'])->name('monitoring.detail');
    Route::post('/validasi-tahap/{id_tahap}/{id_jadwal}', [TahapanController::class, 'validasiTahap'])->name('validasi.tahap');
    Route::post('/validasi-gambar/{id_tahap}/{id_jadwal}', [TahapanController::class, 'validasiGambar'])->name('validasi.gambar');

    // Menampilkan daftar tahapan
    Route::get('/tahapan', [ControllersTahapanController::class, 'show'])->name('tahapan.show');

    // Menampilkan form untuk menambah tahapan
    Route::get('/tahapan/create', [ControllersTahapanController::class, 'create'])->name('tahapan.create');

    // Menyimpan data tahapan yang baru (POST)
    Route::post('/tahapan/store', [ControllersTahapanController::class, 'store'])->name('tahapan.store');

    // Menampilkan form untuk mengedit tahapan berdasarkan ID
    Route::get('/tahapan/{tahap}/edit', [ControllersTahapanController::class, 'edit'])->name('tahapan.edit');

    // Memperbarui data tahapan yang sudah ada berdasarkan ID (PUT)
    Route::put('/tahapan/{tahap}', [ControllersTahapanController::class, 'update'])->name('tahapan.update');

    // Menghapus data tahapan berdasarkan ID (DELETE)
    Route::delete('/tahapan/{tahap}', [ControllersTahapanController::class, 'destroy'])->name('tahapan.destroy');

    Route::get('/kelompokTani', [DataController::class, 'kelompok'])->name('kelompok');
    Route::post('/kelompok-tani/store', [DataController::class, 'store'])->name('kelompok_tani.store');
    Route::get('/kelompok-tani/create', [DataController::class, 'create'])->name('kelompok_tani.create');
    Route::get('/kelompok-tani/edit/{id}', [DataController::class, 'edit'])->name('kelompok_tani.edit');
    Route::put('/kelompok-tani/update/{id}', [DataController::class, 'update'])->name('kelompok_tani.update');
    Route::delete('/kelompok-tani/destroy/{id}', [DataController::class, 'destroy'])->name('kelompok_tani.destroy');

    Route::get('/anggotaTani', [AnggotaController::class, 'index'])->name('anggota.index');
    Route::post('/anggota/store', [AnggotaController::class, 'store'])->name('anggota.store');
    Route::get('/anggota/create', [AnggotaController::class, 'create'])->name('anggota.create');
    Route::get('/anggota/edit/{id}', [AnggotaController::class, 'edit'])->name('anggota.edit');
    Route::put('/anggota/update/{id}', [AnggotaController::class, 'update'])->name('anggota.update');
    Route::delete('/anggota/destroy/{id}', [AnggotaController::class, 'destroy'])->name('anggota.destroy');

    Route::get('/lahan1', [LahanController::class, 'index'])->name('lahan.index');
    Route::post('/lahan/store', [LahanController::class, 'store'])->name('lahan.store');
    Route::get('/lahan/create', [LahanController::class, 'create'])->name('lahan.create');
    Route::get('/lahan/edit/{id}', [LahanController::class, 'edit'])->name('lahan.edit');
    Route::put('/lahan/update/{id}', [LahanController::class, 'update'])->name('lahan.update');
    Route::delete('/lahan/destroy/{id}', [LahanController::class, 'destroy'])->name('lahan.destroy');

    Route::get('/jadwal', [JadwalController::class, 'index'])->name('jadwal.index');
    Route::post('/jadwal/store', [JadwalController::class, 'store'])->name('jadwal.store');
    Route::get('/jadwal/create', [JadwalController::class, 'create'])->name('jadwal.create');
    Route::get('/jadwal/edit/{id}', [JadwalController::class, 'edit'])->name('jadwal.edit');
    Route::put('/jadwal/update/{id}', [JadwalController::class, 'update'])->name('jadwal.update');
    Route::delete('/jadwal/destroy/{id}', [JadwalController::class, 'destroy'])->name('jadwal.destroy');
    Route::get('/get-lahan-size/{id}', [JadwalController::class, 'getLahanSize'])->name('lahan.size');

    Route::get('/lahan', [ApiLahanController::class, 'index']);

    Route::get('/panen', [PanenController::class, 'index'])->name('panen');

    //Route::get('/jadwal/kalender/{jadwal_id}/{bulan}/{tahun}', [HistoryController::class, 'showCalendar'])->name('kalender');
    Route::get('/kalender/{jadwal_id}', [HistoryController::class, 'calender'])->name('calendar.index');
    Route::get('/history-jadwal', [HistoryController::class, 'history'])->name('history-jadwal');

    Route::get('/jadwal/kalender/{jadwal_id}', [HistoryController::class, 'semua'])->name('kalender');

    //Hasil Panen
    Route::get('/hasil-panen', [HasilPanenController::class, 'index'])->name('hasil-panen.index');
    Route::post('/hasil-panen/store', [HasilPanenController::class, 'store'])->name('hasil-panen.store');
    Route::get('/get-pengurus', [HasilPanenController::class, 'getPengurusByLahan'])->name('get-pengurus');
    Route::post('/prediksi', [HasilPanenController::class, 'prediksi'])->name('prediksi');
});
