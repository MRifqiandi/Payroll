<?php

use App\Http\Controllers\Api\AccountController;
use App\Http\Controllers\Api\SlipController;
use App\Http\Controllers\Api\MockApiController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('api_key')->group(function () {
    Route::prefix('account')->group(function () {
        Route::controller(AccountController::class)->group(function () {
            Route::get('/', 'get');
        });
    });

    Route::get('/mock/pegawai', [MockApiController::class, 'getPegawai']);

    Route::prefix('slip')->group(function () {
        Route::controller(SlipController::class)->group(function () {
            Route::get('/list/{account_id}', 'list');
            Route::get('/get/{slip_id}', 'get');
        });
    });
});
