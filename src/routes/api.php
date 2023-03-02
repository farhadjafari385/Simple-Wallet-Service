<?php

use App\Http\Controllers\V1\TransactionController;
use App\Http\Controllers\V1\WalletController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/get-balance/{user}', [WalletController::class, 'getBalance'])->missing(function (Request $request) {
    return response()->failed(
        'User Not Found!'
    );
});
Route::put('/add-money', [TransactionController::class, 'addMoney'])->missing(function (Request $request) {
    return response()->failed(
        'User Not Found!'
    );
});

Route::get('/transactions/{user}', [TransactionController::class, 'index'])->missing(function (Request $request) {
    return response()->failed(
        'User Not Found!'
    );
});
