<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\PaymentController as AdminPaymentController;
use App\Http\Controllers\Admin\PaymentProofController as AdminPaymentProofController;
use App\Http\Controllers\Admin\RaceNumberController as AdminRaceNumberController;
use App\Http\Controllers\Admin\RegistrationController as AdminRegistrationController;
use App\Http\Controllers\AthleteController;
use App\Http\Controllers\ClubController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegistrationController;
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

        Route::get('clubs/{club}/athletes/{athlete}/register', [RegistrationController::class, 'create'])->name('registrations.create');
        Route::post('clubs/{club}/athletes/{athlete}/register', [RegistrationController::class, 'store'])->name('registrations.store');
        Route::get('registrations/{registration}', [RegistrationController::class, 'show'])->name('registrations.show');
        Route::post('registrations/{registration}/payment-proof', [PaymentController::class, 'store'])->name('registrations.payment-proof.store');
    });
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::get('/registrations', [AdminRegistrationController::class, 'index'])->name('registrations.index');
    Route::get('/registrations/{registration}', [AdminRegistrationController::class, 'show'])->name('registrations.show');

    Route::post('/payments/{payment}/approve', [AdminPaymentController::class, 'approve'])->name('payments.approve');
    Route::post('/payments/{payment}/reject', [AdminPaymentController::class, 'reject'])->name('payments.reject');

    Route::post('/registration-items/{registrationItem}/race-number', [AdminRaceNumberController::class, 'store'])->name('race-numbers.store');

    Route::get('/payment-proofs/{paymentProof}', [AdminPaymentProofController::class, 'show'])->name('payment-proofs.show');
});

require __DIR__.'/auth.php';
