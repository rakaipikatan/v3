<?php

use App\Http\Controllers\AthleteController;
use App\Http\Controllers\ClubController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/manager', [ManagerController::class, 'edit'])->name('manager.edit');
    Route::put('/manager', [ManagerController::class, 'update'])->name('manager.update');

    Route::middleware('manager.exists')->group(function () {
        Route::resource('clubs', ClubController::class)->except(['show']);
        Route::resource('clubs.athletes', AthleteController::class)->except(['show']);
    });
});

require __DIR__.'/auth.php';
