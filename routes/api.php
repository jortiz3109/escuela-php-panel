<?php

use App\Http\Controllers\Api\CountryStatusController;
use App\Http\Controllers\Api\PaymentMethodStatusController;
use App\Http\Controllers\Api\UserStatusController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::patch('users/{user}/toggle', [UserStatusController::class, 'toggle'])->name('users.status.toggle');
Route::patch('payment-methods/{payment_method}/toggle', [PaymentMethodStatusController::class, 'toggle'])->name('payment-methods.status.toggle');
Route::patch('countries/{country}/toggle', [CountryStatusController::class, 'toggle'])->name('countries.status.toggle');
