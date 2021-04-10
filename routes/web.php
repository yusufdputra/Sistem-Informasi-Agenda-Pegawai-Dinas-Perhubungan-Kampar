<?php

use App\Http\Controllers\AgendaController;
use App\Http\Controllers\BidangController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PegawaiController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'auth'])->name('/');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

// admin

Route::group(['middleware' => ['role:admin']], function () {
    // kelola pegawai
    Route::get('/pegawai', [PegawaiController::class, 'index'])->name('pegawai.index');
    Route::POST('/pegawai/tambah', [PegawaiController::class, 'tambah'])->name('pegawai.tambah');
    Route::get('/pegawai/edit/{id}', [PegawaiController::class, 'edit'])->name('pegawai/edit');
    Route::POST('/pegawai/edit', [PegawaiController::class, 'update'])->name('pegawai.update');

    // kelola agenda
    Route::get('/agenda', [AgendaController::class, 'index'])->name('agenda.index');
    Route::get('/agenda/tambah', [AgendaController::class, 'tambah'])->name('agenda.tambah');
    Route::get('/agenda/edit/{id}', [AgendaController::class, 'edit'])->name('agenda.edit');
    Route::post('/agenda/update', [AgendaController::class, 'update'])->name('agenda.update');
    Route::post('/agenda/store', [AgendaController::class, 'store'])->name('agenda.store');
    Route::get('/agenda/hapus/{id}', [AgendaController::class, 'hapus'])->name('agenda.hapus');
    
    // kelola bidang
    Route::get('/bidang', [BidangController::class, 'index'])->name('bidang.index');
    Route::post('/bidang/store', [BidangController::class, 'store'])->name('bidang.store');
    Route::post('/bidang/update', [BidangController::class, 'update'])->name('bidang.update');


});

Route::group(['middleware' => ['role:admin|pegawai']], function () {
    Route::get('/agenda', [AgendaController::class, 'index'])->name('agenda.index');
    
    Route::get('/agenda/today', [AgendaController::class, 'getToday'])->name('agenda.today');
});