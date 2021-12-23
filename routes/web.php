<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginLogController;
use App\Http\Controllers\MerchantController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::middleware('auth')->group(function () {
    Route::get('dashboard', DashboardController::class)->name('dashboard');
    Route::get('transactions/{transaction}', [TransactionController::class, 'show'])->name('transactions.show');
    Route::get('merchants', [MerchantController::class, 'index'])->name('merchants.index');
    Route::get('permissions', [PermissionController::class, 'index'])->name('permissions.index');
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::get('logins', LoginLogController::class)->name('logins.index');

    Route::resource('transactions', TransactionController::class)->only(['index', 'show']);
});

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect(RouteServiceProvider::HOME);
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
