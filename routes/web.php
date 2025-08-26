<?php

use App\Http\Controllers\Auth\Admin\LoginController;
use App\Http\Controllers\Front\HomeController as FrontHomeController;
use App\Http\Controllers\Front\ServiceOrderController;
use App\Http\Controllers\Back\MasterData\DeviceRepairController;
use App\Http\Controllers\Back\MasterData\CustomersController;
use App\Http\Controllers\Back\MasterData\StatusController;
use App\Http\Controllers\Back\MasterData\NotaController;
use App\Http\Controllers\Back\MasterData\ReportController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['as' => 'front.'], function () {
    Route::get('/', FrontHomeController::class)->name('home');
    
    // Service Order Routes
    Route::post('/service-order', [ServiceOrderController::class, 'store'])->name('service-order.store');

});

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/', function () {
        return redirect()->route('admin.login');
    });
    
    Route::controller(LoginController::class)->group(function () {
        Route::get('login', 'index')->name('login');
        Route::post('login', 'authenticate')->name('authenticate');
        Route::post('logout', 'logout')->name('logout');
    });

    Route::group(['middleware' => ['auth:web']], function () {

        Route::group(['prefix' => 'MasterData', 'as' => 'MasterData.'], function () {

            Route::resource('customers', CustomersController::class)->except('show')->parameters(['customers' => 'customer']);
            Route::group(['prefix' => 'customers', 'as' => 'customers.'], function () {
                Route::post('data', [CustomersController::class, 'data'])->name('data');
            });

            Route::resource('DeviceRepair', DeviceRepairController::class)->except('show')->parameters(['DeviceRepair' => 'deviceRepair']);
            Route::group(['prefix' => 'DeviceRepair', 'as' => 'DeviceRepair.'], function () {
                Route::post('data', [DeviceRepairController::class, 'data'])->name('data');
                Route::post('{deviceRepair}/update-status', [DeviceRepairController::class, 'updateDeviceRepairStatus'])->name('updateStatus');
            });

            Route::resource('Status', StatusController::class)->except('show')->parameters(['Status' => 'status']);
            Route::group(['prefix' => 'Status', 'as' => 'Status.'], function () {
                Route::post('data', [StatusController::class, 'data'])->name('data');
                Route::post('{status}/update-status', [StatusController::class, 'updateStatus'])->name('updateStatus');
                Route::get('{status}/preview', [StatusController::class, 'preview'])->name('preview');
            });

            Route::resource('Nota', NotaController::class)->only('index');
            Route::group(['prefix' => 'Nota', 'as' => 'Nota.'], function () {
                Route::post('data', [NotaController::class, 'data'])->name('data');
                Route::get('{id}/print', [NotaController::class, 'print'])->name('print');
                Route::get('{id}/pdf', [NotaController::class, 'pdf'])->name('pdf');
            });

            // Report Routes
            Route::resource('Report', ReportController::class)->only('index');
            Route::group(['prefix' => 'Report', 'as' => 'Report.'], function () {
                // Main report pages
                Route::get('daily', [ReportController::class, 'daily'])->name('daily');
                Route::get('weekly', [ReportController::class, 'weekly'])->name('weekly');
                Route::get('monthly', [ReportController::class, 'monthly'])->name('monthly');
                Route::get('brand', [ReportController::class, 'brand'])->name('brand');
                Route::get('issue', [ReportController::class, 'issue'])->name('issue');
                Route::get('history', [ReportController::class, 'history'])->name('history');
                
                // Data endpoints
                Route::post('daily/data', [ReportController::class, 'dailyData'])->name('daily.data');
                Route::post('weekly/data', [ReportController::class, 'weeklyData'])->name('weekly.data');
                Route::post('monthly/data', [ReportController::class, 'monthlyData'])->name('monthly.data');
                Route::post('brand/data', [ReportController::class, 'brandData'])->name('brand.data');
                Route::post('issue/data', [ReportController::class, 'issueData'])->name('issue.data');
                Route::post('history/data', [ReportController::class, 'historyData'])->name('history.data');
                Route::post('history/summary', [ReportController::class, 'historySummary'])->name('history.summary');
                
                // Export endpoints
                Route::get('export/pdf', [ReportController::class, 'exportPdf'])->name('export.pdf');
                Route::get('export/excel', [ReportController::class, 'exportExcel'])->name('export.excel');
            });

        });

    });
});
