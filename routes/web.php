<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CheckInController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard')->middleware(['auth']);


Route::get('/checkin', [CheckInController::class, 'create'])->name('checkin')->middleware(['auth']);

Route::post('/checkin', [CheckInController::class, 'store'])->name('checkin.store')->middleware(['auth']);

Route::get('/checkin/{checkIn}', [CheckInController::class, 'show'])->name('checkin.show')->middleware(['auth']);

Route::get('/feedback', [CheckInController::class, 'index'])->name('feedback')->middleware(['auth']);

Route::get('/profile', function () {
    return view('profile');
})->name('profile')->middleware(['auth']);

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';
