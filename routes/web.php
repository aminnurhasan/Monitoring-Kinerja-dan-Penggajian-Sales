<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminHomeController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminTokoController;
use App\Http\Controllers\AdminTransaksiController;
use App\Http\Controllers\AdminGajiController;
use App\Http\Controllers\AdminKinerjaController;

use App\Http\Controllers\OwnerHomeController;
use App\Http\Controllers\OwnerUserController;
use App\Http\Controllers\OwnerMasterGajiController;
use App\Http\Controllers\OwnerKinerjaController;

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
    return view('auth/login');
});

Route::middleware(['auth', 'owner'])->group(function () {
    Route::get('/dashboard', [OwnerHomeController::class, 'index'])->name('dashboard');
    Route::resource('/owner/user', OwnerUserController::class);
    Route::resource('/owner/master', OwnerMasterGajiController::class);  
    Route::resource('/owner/kinerja', OwnerKinerjaController::class); 

    Route::post('/owner/kinerja/input', [OwnerKinerjaController::class, 'input'])->name('input');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/home', [AdminHomeController::class, 'index'])->name('home');
    Route::resource('/admin/toko', AdminTokoController::class);
    Route::resource('/admin/user', AdminUserController::class);
    Route::resource('/admin/transaksi', AdminTransaksiController::class);
    Route::resource('/admin/gaji', AdminGajiController::class);    
    Route::resource('/admin/kinerja', AdminKinerjaController::class);

    Route::post('chart', [AdminKinerjaController::class, 'chart']);

    Route::get('/admin/toko/status/{id}', [AdminTokoController::class, 'status'])->name('statusToko');
    Route::get('/admin/user/status/{id}', [AdminUserController::class, 'status'])->name('statusUser');

    Route::get('/cetakpdf', [AdminTransaksiController::class, 'cetakPDF'])->name('cetakTransaksi');
    Route::get('/halCetakGaji', [AdminGajiController::class, 'halCetakGaji'])->name('halCetakGaji');
    Route::get('/cetakGaji', [AdminGajiController::class, 'cetakPDF'])->name('cetakGaji');
    
});

Auth::routes();