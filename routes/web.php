<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TokoController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\GajiController;
use App\Http\Controllers\KinerjaController;

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


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'admin'], function (){
    Route::resource('toko', TokoController::class);
    Route::resource('user', UserController::class);
    Route::resource('transaksi', TransaksiController::class);
    Route::resource('gaji', GajiController::class);    
    Route::resource('kinerja', KinerjaController::class);

    // Route::get('/sales-dropdown', [KinerjaController::class, 'getSalesDropdown']);
    Route::post('chart', [KinerjaController::class, 'chart']);
    Route::get('toko/status/{id}', [TokoController::class, 'status'])->name('status');
});