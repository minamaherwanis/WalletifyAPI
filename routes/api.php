<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\WalletController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/test', function () {
    return response()->json(['message' => 'API is working']);
});

Route::post('/register', [AuthController::class, 'register']);
Route::get('/verify-email', [AuthController::class, 'verifyEmail']);
Route::post('/login', [AuthController::class, 'login']);

Route::post('/paymob/webhook', [WalletController::class, 'webhook']);
Route::get('/paymob/response', [WalletController::class, 'response']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/wallet/balance', [WalletController::class, 'getBalance']);
    Route::post('/wallet/deposit', [WalletController::class, 'deposit']);
    Route::get('/wallet/logs', [WalletController::class, 'logs']);
    Route::post('/wallet/transfer', [WalletController::class, 'transfer']);
});
