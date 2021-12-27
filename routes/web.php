<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginLogController;
use App\Http\Controllers\MerchantController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\TransactionController;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::middleware('auth')->group(function () {
    Route::get('dashboard', DashboardController::class)->name('dashboard');

    Route::resource('merchants', MerchantController::class)->only(['index', 'create', 'edit', 'show']);

    Route::get('permissions', [PermissionController::class, 'index'])->name('permissions.index');

    Route::get('logins', LoginLogController::class)->name('logins.index');

    Route::resource('transactions', TransactionController::class)->only(['index', 'show']);

    Route::view('/email/verify', 'auth.verify-email')->name('verification.notice');
});

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect(RouteServiceProvider::HOME);
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
