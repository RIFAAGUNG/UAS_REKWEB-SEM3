<?php


use App\Http\Controllers\LoginController;
use App\Http\Controllers\HotelController;
use Illuminate\Support\Facades\Route;

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth.user'])->group(function () {
    Route::resource('Hotel', HotelController::class);
    Route::get('Hotel/export/pdf', [HotelController::class, 'exportPdf'])->name('Hotel.export.pdf');
});