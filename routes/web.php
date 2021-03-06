<?php

use App\Http\Controllers\CountryController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginLogController;
use App\Http\Controllers\MerchantController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VerifyEmailController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::middleware('auth')->group(function () {
    Route::get('countries', [CountryController::class, 'index'])->name('countries.index');

    Route::get('currencies', [CurrencyController::class, 'index'])->name('currencies.index');

    Route::get('dashboard', DashboardController::class)->name('dashboard');

    Route::resource('users', UserController::class)->only(['index', 'create', 'store',  'edit', 'update']);

    Route::resource('merchants', MerchantController::class)->except(['destroy']);

    Route::resource('payment-methods', PaymentMethodController::class)->only('index');

    Route::get('logins', LoginLogController::class)->name('logins.index');

    Route::resource('transactions', TransactionController::class)->except(['destroy']);

    Route::resource('permissions', PermissionController::class)->only(['index', 'edit', 'update']);

    Route::view('/email/verify', 'auth.verify-email')->name('verification.notice');
});

Route::get('/email/verify/{id}/{hash}', [VerifyEmailController::class, 'verifies'])
    ->middleware(['signed', 'throttle:6,1'])
    ->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
