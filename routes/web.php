<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginLogController;
use App\Http\Controllers\PermissionController;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::view('/', 'welcome');

Route::get('/dashboard', DashboardController::class)
    ->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::name('permissions.index')->get('/permissions', [PermissionController::class, 'index']);

    Route::name('logins.index')->get('/logins', LoginLogController::class);

    Route::name('users.create')->get('/register', [UserController::class, 'create']);
    Route::name('users.store')->post('/register', [UserController::class, 'store']);
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
