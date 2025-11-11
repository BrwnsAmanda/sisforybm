<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Admin\Auth\LoginController;

Route::prefix('adminybm')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('filament.adminybm.auth.login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::post('/logout', [LoginController::class, 'logout'])->name('filament.adminybm.auth.logout');
});

Route::get('/', function () {
    return view('landing.home'); // PENTING: gunakan titik untuk folder
})->name('home');


Route::get('/tentang', function () {
    return view('landing.about');
})->name('about');


Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/dashboard', function () {
    return view('dashboard.dashboard');
})->name('dashboard');

use App\Http\Controllers\EkonomiController;

Route::post('/ekonomi/store', [EkonomiController::class, 'store']);
