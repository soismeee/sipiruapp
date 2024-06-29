<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PeminjamanController;

route::get('/', [HomeController::class, 'index'])->middleware('auth');
route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');
route::get('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');
route::get('/register', [AuthController::class, 'register'])->name('register')->middleware('guest');
route::post('/auth', [AuthController::class, 'authenticate'])->name('auth')->middleware('guest');
route::post('/auth2', [AuthController::class, 'authenticate2'])->name('auth2')->middleware('guest');
route::post('/regist', [AuthController::class, 'store'])->name('regist')->middleware('guest');
route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

route::get('/lengkapidata', [HomeController::class, 'lengkapiData'])->name('lengkapidata')->middleware('auth');
route::post('/sk', [HomeController::class, 'store'])->name('sk')->middleware('auth');

// peminjaman
route::get('/p', [PeminjamanController::class, 'index'])->name('p')->middleware('auth');
route::get('/cp', [PeminjamanController::class, 'create'])->name('cp')->middleware('auth');
route::get('/rp', [PeminjamanController::class, 'riwayat'])->name('rp')->middleware('auth');
route::get('/get_p', [PeminjamanController::class, 'getPeminjaman'])->name('get_p')->middleware('auth');
route::get('/cek_p/{id}', [PeminjamanController::class, 'cekPeminjaman'])->name('cek_p')->middleware('auth');
route::post('/json_rp', [PeminjamanController::class, 'jsonRiwayat'])->name('json_rp')->middleware('auth');
route::post('/save', [PeminjamanController::class, 'store'])->name('save')->middleware('auth');
route::post('/proses/{id}', [PeminjamanController::class, 'prosesStatus'])->name('proses')->middleware('auth');
route::delete('/del_p/{id}', [PeminjamanController::class, 'destroy'])->name('del_p')->middleware('auth');

// informasi aula
route::get('/i', [HomeController::class, 'informasiAula'])->name('i')->middleware('auth');

// laporan
route::get('/lp', [HomeController::class, 'laporan'])->name('lp')->middleware('auth');
route::get('/get_l', [HomeController::class, 'getLaporan'])->name('get_l')->middleware('auth');
route::post('/cetak', [HomeController::class, 'cetakLaporan'])->name('cetak')->middleware('auth');

// profil
route::get('/profile', [HomeController::class, 'profile'])->name('profile')->middleware('auth');
route::post('/change_profile', [HomeController::class, 'update'])->name('change_profile')->middleware('auth');
