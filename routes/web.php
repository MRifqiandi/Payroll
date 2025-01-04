<?php

use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\ApiKeyController;
use App\Http\Controllers\AuthenticatorController;
use App\Http\Controllers\Finance\UploadController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SlipController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('auth')->group(function () {
    Route::controller(ProfileController::class)->group(function () {
        Route::post('/profile/update/password', 'updatePassword')->name('profile.update.password');
    });

    Route::controller(SlipController::class)->group(function () {
        Route::get('/', 'index')->name('slip.index');
        Route::get('/donwload/{id}', 'download')->name('slip.download');

        Route::get('/get/table', 'getDatatable')->name('slip.table');
    });

    Route::prefix('authenticator')->group(function () {
        Route::controller(AuthenticatorController::class)->group(function () {
            Route::post('/enable', 'enable')->name('authenticator.enable');
            Route::post('/disable', 'disable')->name('authenticator.disable');
            Route::post('/verify', 'verify')->name('authenticator.verify');
        });
    });

    Route::middleware('role:admin|finance')->group(function () {
        Route::prefix('upload')->group(function () {
            Route::controller(UploadController::class)->group(function () {
                Route::get('/', 'index')->name('upload.index');
                Route::post('/store', 'store')->name('upload.store');
                Route::get('/download/{id}', 'download')->name('upload.download');
                Route::get('/receivers', 'getReceivers')->name('upload.receivers');
                Route::post('/delete', 'delete')->name('upload.delete');

                Route::get('/get/table', 'getDatatable')->name('upload.table');
            });
        });
    });

    Route::middleware('role:admin')->group(function () {
        Route::prefix('account')->group(function () {
            Route::controller(AccountController::class)->group(function () {
                Route::get('/', 'index')->name('account.index');
                Route::post('/store', 'store')->name('account.store');
                Route::post('/update', 'update')->name('account.update');
                Route::post('/update/password', 'updatePassword')->name('account.update.password');
                Route::post('/disable/authenticator', 'disableAuthenticator')->name('account.disable.authenticator');
                Route::post('/delete', 'delete')->name('account.delete');

                Route::get('/get/table', 'getDatatable')->name('account.table');
            });
        });
    });

    Route::middleware('role:admin')->group(function () {
        Route::prefix('api-key')->group(function () {
            Route::controller(ApiKeyController::class)->group(function () {
                Route::get('/', 'index')->name('api-key.index');
                Route::post('/store', 'store')->name('api-key.store');
                Route::post('/delete', 'delete')->name('api-key.delete');

                Route::get('/get/table', 'getDatatable')->name('api-key.table');
            });
        });
    });
});

require __DIR__ . '/auth.php';
