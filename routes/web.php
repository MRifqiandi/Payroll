<?php

use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\ApiKeyController;
use App\Http\Controllers\AuthenticatorController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\Finance\UploadController;
use App\Http\Controllers\Payroll\SalaryController;
use App\Http\Controllers\Payroll\SalaryRaiseController;
use App\Http\Controllers\BpjsController;
use App\Http\Controllers\Payroll\SalaryStatusController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\EmployeeSalaryController;
use App\Http\Controllers\Payroll\TaxController;
use App\Http\Controllers\Payroll\PayrollController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KgbController;
use App\Http\Controllers\LogActivityController;
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

Route::middleware('role:admin|finance')->group(function () {
    Route::prefix('admin-employee')->group(function () {
        Route::get('/employee', [EmployeeController::class, 'index'])->name('admin.employee.index');
        Route::get('/employee/edit', [EmployeeController::class, 'edit'])->name('employee.edit');
        Route::put('/employee/update', [EmployeeController::class, 'update'])->name('employee.update');
        Route::delete('/employee/{id}', [EmployeeController::class, 'destroy'])->name('employee.destroy');
        Route::get('/employee/create', [EmployeeController::class, 'create'])->name('employee.create');
        Route::post('/employee', [EmployeeController::class, 'store'])->name('employee.store');
        });
    });


Route::middleware(['auth'])->group(function () {
    Route::get('/tax', [TaxController::class, 'index'])->name('tax.index');
    Route::get('/tax/my-tax', [TaxController::class, 'myTax'])->name('tax.myTax');
    Route::get('/tax/export-pdf/{id}', [TaxController::class, 'exportBuktiPotongPDF'])->name('tax.exportBuktiPotongPDF');
    Route::delete('/tax/{id}', [TaxController::class, 'destroy'])->name('tax.destroy');
    Route::get('/my-tax', [TaxController::class, 'myTax'])->name('tax.user');
});


Route::middleware('role:admin|finance')->group(function () {
    Route::prefix('admin-employee')->group(function () {
    });

});

Route::post('/payroll/hitung-gaji-semua', [PayrollController::class, 'generateAllSalaries'])->name('payroll.hitung-gaji-semua');
Route::get('/prediksi-kgb', [EmployeeController::class, 'prediksiKGB'])->name('employee.prediksiKGB');

Route::post('/kgb/update-prediksi', [KgbController::class, 'updatePrediksiManual'])->name('kgb.update-prediksi.manual');

Route::get('/payroll/generate', [PayrollController::class, 'showGenerate'])->name('payroll.generate');
Route::post('/payroll/hitung-gaji', [PayrollController::class, 'hitungGaji'])->name('payroll.hitung-gaji');
Route::get('/payroll', [PayrollController::class, 'index']);
Route::get('/payroll/result', [PayrollController::class, 'showResult'])->name('payroll.result');

Route::post('/payroll/check-existing-salary', [PayrollController::class, 'checkExistingSalary'])->name('payroll.checkExistingSalary');

Route::get('/payroll/slip/{id}/pdf', [PayrollController::class, 'exportKustomPDF'])->name('payroll.slip.pdf');

Route::get('/payroll/{id}/edit', [PayrollController::class, 'edit'])->name('payroll.edit');
Route::put('/payroll/{id}/{employeeId}/{periodeGaji}', [PayrollController::class, 'update'])->name('payroll.update');

Route::get('/salary-raises', [SalaryRaiseController::class, 'index'])->name('salary_raise.index');

Route::post('/payroll/check-existing-salary-all', [PayrollController::class, 'checkExistingSalaryAll']);

Route::delete('/payroll/{id}', [PayrollController::class, 'destroy'])->name('payroll.destroy');

Route::get('/log-activity', [LogActivityController::class, 'index'])->name('log_activity.index');

Route::put('/payroll/{id}/update-tunjangan', [PayrollController::class, 'updateTunjanganLainLain'])->name('payroll.updateTunjanganLainLain');

Route::middleware('role:admin|finance|staff')->prefix('laporan')->group(function () {
    Route::controller(LaporanController::class)->group(function () {
        Route::get('/', 'index')->name('laporan.index');                    // /laporan
        Route::get('/upload', 'create')->name('laporan.create');            // /laporan/upload
        Route::get('/laporan/list', [LaporanController::class, 'list'])->name('laporan.list');
        Route::get('/laporan/download/{id}', [LaporanController::class, 'download'])->name('laporan.download');
        Route::delete('/laporan/{id}', [LaporanController::class, 'destroy'])->name('laporan.destroy');

        Route::post('/', 'store')->name('laporan.store');                   // /laporan (POST)
        Route::get('/jenis/{jenis}', 'byJenis');
        Route::get('/laporan/jenis/{jenis}', [LaporanController::class, 'byJenis'])->name('laporan.byJenis');
        Route::get('/{id}', 'show');
        Route::delete('/{id}', 'destroy');
    });
});

Route::middleware('role:staff|admin|finance')->prefix('laporan-bpjs')->group(function () {
    Route::controller(BpjsController::class)->group(function () {
    Route::get('/bpjs-saya', [BpjsController::class, 'myBpjs'])->name('my.bpjs');;
     Route::get('/bpjs', [BpjsController::class, 'index'])->name('admin.bpjs.index');
      Route::get('/bpjs/exportPDF/{id}', [BpjsController::class, 'exportPDF'])->name('admin.bpjs.exportPDF');
      Route::delete('/bpjs/{id}', [BpjsController::class, 'destroy'])->name('bpjs.destroy');

    });
});

    Route::middleware(['auth', 'role:staff'])->group(function () {
        Route::prefix('salary-employee')->group(function () {
            Route::controller(EmployeeSalaryController::class)->group(function () {
                 Route::get('/salary', [EmployeeSalaryController::class, 'index'])->name('salary.index');
                    Route::get('/salary/slip/{id}', [EmployeeSalaryController::class, 'downloadSlip'])->name('salary.slip');
            });
        });
    });

    Route::middleware(['auth', 'role:staff'])->group(function () {
        Route::prefix('bpjs-employee')->group(function () {
            Route::controller(BpjsController::class)->group(function () {

            });
        });
    });

Route::get('/salary/detail-pph21', function () {
    if (!session()->has('pph21_detail')) abort(404);
    return view('pages.payroll.tax-detail', session('pph21_detail'));
})->name('salary.tax_detail');

Route::get('/taxes', [TaxController::class, 'index'])->name('tax.index');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::middleware(['auth', 'role:staff'])->group(function () {
    Route::get('/profil-saya', [EmployeeController::class, 'profile'])->name('employee.profile');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/bpjs', [BpjsController::class, 'index'])->name('bpjs.index');
    Route::get('/my-bpjs', [BpjsController::class, 'myBpjs'])->name('bpjs.myBpjs');
    Route::get('/bpjs/pdf/{id}', [BpjsController::class, 'exportPDF'])->name('bpjs.exportPDF');
    Route::delete('/bpjs/{id}', [BpjsController::class, 'destroy'])->name('bpjs.destroy');
});


Route::get('/bpjs-saya', [BpjsController::class, 'myBpjs'])
    ->middleware(['auth', 'role:staff']) // Sesuaikan middleware dengan sistemmu
    ->name('bpjs.my');


Route::middleware(['auth', 'role:staff'])->group(function () {
    Route::get('/salary-raise-history-user', [SalaryRaiseController::class, 'myRaises'])->name('salary.raise.user');
});

Route::get('/salary-raise-history', [SalaryRaiseController::class, 'index'])->name('salary.raise.history');

require __DIR__ . '/auth.php';
