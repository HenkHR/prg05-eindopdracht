<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CheckInController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\PostController; 
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/dashboard', [PostController::class, 'index'])->name('dashboard')->middleware(['auth']);

Route::post('/posts', [PostController::class, 'store'])->name('posts.store')->middleware(['auth', 'admin']);

Route::get('/posts/{post}/edit', [PostController::class, 'edit'])
    ->name('posts.edit')
    ->middleware(['auth', 'admin']);

Route::patch('/posts/{post}', [PostController::class, 'update'])
    ->name('posts.update')
    ->middleware(['auth', 'admin']);

Route::delete('/posts/{post}', [PostController::class, 'destroy'])
    ->name('posts.destroy')
    ->middleware(['auth', 'admin']);

Route::post('/posts/{post}/toggle-visibility', [PostController::class, 'toggleVisibility'])
    ->name('posts.toggleVisibility')
    ->middleware(['auth', 'admin']);

Route::get('/checkin', [CheckInController::class, 'create'])->name('checkin')->middleware(['auth']);

Route::post('/checkin', [CheckInController::class, 'store'])->name('checkin.store')->middleware(['auth']);

Route::get('/checkin/{checkIn}', [CheckInController::class, 'show'])->name('checkin.show')->middleware(['auth']);

Route::get('/checkins/today', [CheckInController::class, 'todayCheckIns'])
    ->name('checkins.today')
    ->middleware(['auth', 'admin']);

Route::patch('/checkin/{checkIn}/comment', [CheckInController::class, 'addComment'])
    ->name('checkin.addComment')
    ->middleware(['auth', 'admin']);

Route::get('/feedback', [CheckInController::class, 'index'])->name('feedback')->middleware(['auth']);

Route::get('/weekly-report', [CheckInController::class, 'weeklyReport'])
    ->name('weekly.report')
    ->middleware(['auth']);

Route::get('/clients', [ClientController::class, 'index'])->name('clients')->middleware(['auth','admin']);
Route::get('/clients/{user}', [ClientController::class, 'show'])->name('clients.show')->middleware(['auth', 'admin']);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
