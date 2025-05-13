<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\akunController;


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/form', [FormController::class, 'index'])->name('forms');
Route::get('/table', [TableController::class, 'index'])->name('table');
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::get('/calendar', [BookingController::class, 'calendar']);
Route::get('/akun', [akunController::class, 'akun']);


Route::get('/', function () {
    return view('login');
});
