<?php


use PrinceRai\CustomAuth\Controllers\LoginController;
use PrinceRai\CustomAuth\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['web'])->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/custom-login', [LoginController::class, 'authLogin'])->name('custom.login');
    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('custom.register');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/home', [LoginController::class, 'home'])->name('home');
});

