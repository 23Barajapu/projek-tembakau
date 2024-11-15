<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\BarangPanenController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PengunjungController;
use App\Http\Controllers\RajaOngkirController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\SesiController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;

Route::get('/login', function () {
    return view('login');
});

Route::get('/error', function () {
    return view('error-404');
});
// Route untuk menampilkan daftar review
Route::post('/testimoni', [SesiController::class, 'reviewstore'])->name('review.store');
Route::get('/testimoni',  [SesiController::class, 'showReviews'])->name('review.show');
// Route untuk menyimpan review

Route::post('/logout', [SesiController::class, 'logout'])->name('logout');
Route::post('/login', [SesiController::class, 'login']);
Route::post('/register', [RegistrationController::class, 'register'])->name('register');
Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/home', [HomeController::class, 'home'])->name('home');
Route::get('/tentangKami', [HomeController::class, 'tentangKami'])->name('tentangKami');
Route::get('/filter', [HomeController::class, 'filter'])->name('home.filter');

//reset password
// Route::get('/forgot-password', [PasswordController::class, 'showLinkRequestForm'])->name('password.request');
// Route::post('/forgot-password', [PasswordController::class, 'sendResetLinkEmail'])->name('password.email');
// Route::get('/reset-password/{token}', [PasswordController::class, 'showResetForm'])->name('password.reset');
// Route::post('/reset-password', [PasswordController::class, 'reset'])->name('password.update');



// Middleware untuk route yang butuh autentikasi
Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index']);
    Route::get('/logout', [SesiController::class, 'logout']);
    Route::get('/profile', [ HomeController::class, 'show'])->name('profile.show') ;
    Route::get('/profile/edit', [ HomeController::class, 'edit'])->name('profile.edit') ;
    Route::post('/profile/update', [ HomeController::class, 'update'])->name('profile.update') ;
    //pemesanan
    Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
    Route::get('/shop-detail/{id_brg}', [ShopController::class, 'detail'])->name('shop-detail');
    
    //keranjang
    Route::post('/keranjang', [KeranjangController::class, 'keranjang'])->name('FrontEnd.keranjang');
    Route::get('/keranjang', [KeranjangController::class, 'showCart'])->name('FrontEnd.showCart');
    Route::post('/update-cart', [KeranjangController::class, 'updateCart']);
    Route::post('/delete-cart', [KeranjangController::class, 'deleteCart']);

    //checkout
    Route::get('/form-pembelian', [PembelianController::class, 'formPembelian'])->name('form-pembelian');
    Route::post('/form-pembelian', [PembelianController::class, 'cekOngkir'])->name('form.ongkir');
    Route::post('/konfirmasi-pembayaran', [PembayaranController::class, 'pay'])->name('konfirmasi.pembayaran');
    Route::get('/payment/success', [PembayaranController::class, 'paymentSuccess']);
    Route::post('/pembayaran', [PembayaranController::class, 'pay']);
    Route::get('/invoice/{id}', [InvoiceController::class, 'generateInvoice'])->name('invoice.generate');

    //status-history Pelanggan
    Route::get('/status', [PembelianController::class, 'status'])->name('pemesanan.status');
    Route::patch('/update-status/{id}', [PembelianController::class, 'updateStatus'])->name('update-status');
    Route::get('/history', [PembelianController::class, 'history'])->name('pemesanan.history');
    
    //status-history Admin
    Route::get('/admin/status', [PembelianController::class, 'AdminStatus'])->name('pemesanan.adminStatus');
    Route::get('/admin/history', [PembelianController::class, 'historyAdmin'])->name('pemesanan.adminhistory');
    Route::put('/pemesanan/update-status/{id}', [PembelianController::class, 'updateStatusSS'])->name('update-statusSS');

    //dashboard admin
    Route::get('/admin', [LaporanController::class, 'admin'])->name('laporan.admin');
    Route::get('/admin.sale', [LaporanController::class, 'sale'])->name('sale.admin');
    Route::get('/admin.revenue', [LaporanController::class, 'revenue'])->name('revenue.admin');

    //profile Admin
    Route::get('/admin/profile', [ HomeController::class, 'admin_show'])->name('admin_profile.show') ;
    Route::get('/admin/profile/edit', [ HomeController::class, 'admin_edit'])->name('admin_profile.edit') ;
    Route::post('/admin/profile/update', [ HomeController::class, 'admin_update'])->name('admin_profile.update') ;

    //laporan
    Route::get('/admin/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/admin/laporan/export-pdf', [LaporanController::class, 'exportPdf'])->name('laporan.export');

    // Barang Panen
    Route::get('/barang_panen/create', [BarangPanenController::class, 'create'])->name('barang_panen.create');
    Route::get('/barang_panen/{id_brg}/edit', [BarangPanenController::class, 'edit'])->name('barang_panen.edit');
    Route::post('/barang_panen/store', [BarangPanenController::class, 'store'])->name('barang_panen.store');
    Route::get('/barang_panen', [BarangPanenController::class, 'index'])->name('BackEnd.barang_panen');
    Route::get('/barang-panen/filter', [BarangPanenController::class, 'filter'])->name('barang_panen.filter');

    //Kategori
    Route::get('/kategori', [KategoriController::class, 'index'])->name('BackEnd.kategori');
    Route::get('/kategori/create', [KategoriController::class, 'create'])->name('kategori.create');
    Route::get('/kategori/{kategori}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
    Route::put('/kategori/{kategori}', [KategoriController::class, 'update'])->name('kategori.update');
    Route::post('/kategori/store', [KategoriController::class, 'store'])->name('kategori.store');

    //RAJAONGKIR
    Route::get('/ongkir', [RajaOngkirController::class, 'index']);
    Route::get('/province', [RajaOngkirController::class, 'getProvinces']);
    Route::get('/cities/{province_id}', [RajaOngkirController::class, 'getCities']);
    Route::post('/cost', [RajaOngkirController::class, 'getCost']);
});

// Middleware untuk tamu
Route::middleware(['guest'])->group(function () {
    Route::get('/register', [RegistrationController::class, 'showRegistrationForm'])->name('register');
    Route::get('/login', [SesiController::class, 'index'])->name('login');
});

// Resources
Route::resource('barang_panen', BarangPanenController::class)->except(['show']);
Route::resource('kategori', KategoriController::class);