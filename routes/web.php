<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TwoFactorAuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth' , "password_changed" , "verified" , "2fa"])->name('dashboard');

Route::middleware(['auth' , "password_changed" , "2fa"])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/2fa', [TwoFactorAuthController::class, 'store'])->name('2fa.store');
});

require __DIR__.'/auth.php';
