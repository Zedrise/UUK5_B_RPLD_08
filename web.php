<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\JadwalKeretaController;
use App\Http\Controllers\AdminUserController;


Route::get('/', function () {
    return view('home');
});

// auth
Route::get('/login', [AuthController::class, 'showAuth'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');



// admin

Route::middleware(['auth', 'role:admin'])->group(function () {

    // Dashboard admin
    Route::get('/admin/dashboard', [AdminController::class, 'index'])
        ->name('admin.dashboard');

    // Jadwal Kereta
    Route::get('/admin/jadwal', [JadwalKeretaController::class, 'index'])
        ->name('admin.jadwal.index');

    Route::get('/admin/jadwal/create', [JadwalKeretaController::class, 'create'])
        ->name('admin.jadwal.create');

    Route::post('/admin/jadwal/store', [JadwalKeretaController::class, 'store'])
        ->name('admin.jadwal.store');

    Route::get('/admin/jadwal/{id}/edit', [JadwalKeretaController::class, 'edit'])
        ->name('admin.jadwal.edit');

    Route::put('/admin/jadwal/{id}/update', [JadwalKeretaController::class, 'update'])
        ->name('admin.jadwal.update');


    Route::get('/admin/jadwal', [JadwalKeretaController::class, 'index'])
        ->name('admin.jadwal.index');

    Route::delete('/admin/jadwal/{id}/delete', [JadwalKeretaController::class, 'destroy'])
        ->name('admin.jadwal.delete');
    // pesanan
    Route::get('/admin/pesanan', [AdminOrderController::class, 'index'])
        ->name('admin.orders');

    Route::get('/admin/pesanan/{id}', [AdminOrderController::class, 'detail'])
        ->name('admin.orders.detail');

    Route::post('/admin/pesanan/{id}/status', [AdminOrderController::class, 'updateStatus'])
        ->name('admin.orders.status');
    // bagian pengguna
    Route::get('/admin/users', [AdminUserController::class, 'index'])
        ->name('admin.users');
         
    Route::get('/admin/users/create', [AdminUserController::class, 'create'])
        ->name('admin.users.create');
         
    Route::post('/admin/users/store', [AdminUserController::class, 'store'])
        ->name('admin.users.store');
         
    Route::get('/admin/users/{id}/edit', [AdminUserController::class, 'edit'])
        ->name('admin.users.edit');
         
    Route::post('/admin/users/{id}/update', [AdminUserController::class, 'update'])
        ->name('admin.users.update');

    Route::delete('/admin/users/{id}/delete', [AdminUserController::class, 'destroy'])
        ->name('admin.users.delete');    
    // cetak laporan  
    Route::get('/admin/pesanan/laporan', [AdminOrderController::class, 'laporan'])
        ->name('admin.pesanan.laporan');

    Route::get('/admin/pesanan/cetak', [AdminOrderController::class, 'cetakPdf'])
        ->name('admin.pesanan.cetak');    

    Route::get('/admin/cetak-pesanan/{id}', [AdminOrderController::class, 'cetakPesanan'])
        ->name('admin.laporan.cetak');

    Route::get('/admin/pesanan/cetak/{id}', [AdminOrderController::class, 'cetakPerPesanan'])
        ->name('admin.orders.cetak');
    
});



// petugas

Route::middleware(['auth', 'role:petugas'])
    ->prefix('petugas')
    ->group(function () {


    Route::get('/dashboard', [PetugasController::class, 'dashboard'])
        ->name('petugas.dashboard');

    Route::get('/pesanan', [PetugasController::class, 'index'])
        ->name('petugas.pesanan');
    // list
    Route::get('/pesanan/{id}', [PetugasController::class, 'detail'])
        ->name('petugas.pesanan.detail');
    // detail
    Route::get('/pesanan/{id}', [PetugasController::class, 'detail'])
        ->name('petugas.pesanan.detail');
    // update 
    Route::post('/pesanan/{id}/status', [PetugasController::class, 'updateStatus'])
        ->name('petugas.pesanan.status');   
    
    // jadwal 
    Route::get('/jadwal', [PetugasController::class, 'jadwal'])
        ->name('petugas.jadwal');
    Route::get('/jadwal/tambah', [PetugasController::class, 'tambahJadwal'])
        ->name('petugas.jadwal.tambah');

    Route::post('/jadwal/tambah', [PetugasController::class, 'storeJadwal'])
        ->name('petugas.jadwal.store');

    Route::get('/jadwal/edit/{id}', [PetugasController::class, 'editJadwal'])
        ->name('petugas.jadwal.edit');

    Route::post('/jadwal/update/{id}', [PetugasController::class, 'updateJadwal'])
        ->name('petugas.jadwal.update');

    Route::delete('/jadwal/hapus/{id}', [PetugasController::class, 'hapusJadwal'])
        ->name('petugas.jadwal.hapus');   
});

//  PELANGGAN AREA

Route::middleware(['auth', 'role:pelanggan'])->group(function () {

    // DASHBOARD PELANGGAN
    Route::get('/pelanggan/dashboard', [PelangganController::class, 'dashboard'])
        ->name('pelanggan.dashboard');

    // MELIHAT JADWAL
    Route::get('/pelanggan/jadwal', [PelangganController::class, 'jadwal'])
        ->name('pelanggan.jadwal');

    // PESAN LANGSUNG (versi 1 item)
    Route::get('/pesan/{id}', [PelangganController::class, 'pesan'])
        ->name('pelanggan.pesan');
    Route::post('/pesan/{id}', [PelangganController::class, 'store'])
        ->name('pelanggan.pesan.store');

    // KERANJANG 
    Route::post('/keranjang/tambah', [PelangganController::class, 'tambahKeranjang'])
        ->name('pelanggan.keranjang.tambah');
    Route::get('/keranjang', [PelangganController::class, 'keranjang'])
        ->name('pelanggan.keranjang');
    Route::post('/checkout', [PelangganController::class, 'checkout'])
        ->name('pelanggan.checkout');

    // RIWAYAT PESANAN
    Route::get('/pesanan', [PelangganController::class, 'pesanan'])
        ->name('pelanggan.pesanan');
    Route::get('/pesanan/{id}', [PelangganController::class, 'detailPesanan'])
        ->name('pelanggan.pesanan.detail');

    // CETAK STRUK / NOTA
    Route::get('/cetak/{id}', [PelangganController::class, 'cetakStruk'])
        ->name('pelanggan.cetak');

    Route::delete('/keranjang/hapus/{id}', [PelangganController::class,'hapusKeranjang'])
        ->name('pelanggan.keranjang.hapus');
    
});
