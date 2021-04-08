<?php

use App\Http\Controllers\MoneyReceiverController;
use App\Http\Controllers\VendingMachineController;
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

Route::middleware('api')->group(function () {
    Route::put('/money-receiver/banknote/insert/{banknote_id}', [MoneyReceiverController::class, 'setBanknote']);
    Route::put('/money-receiver/coin/insert/{banknote_id}', [MoneyReceiverController::class, 'setCoin']);
    Route::post('/vending-machine/buy/{product_id}', [VendingMachineController::class, 'buy']);
    Route::post('/vending-machine/get-change', [VendingMachineController::class, 'getChange']);
});
