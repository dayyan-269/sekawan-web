<?php

//ADMIN
use App\Http\Controllers\Admin\HomeController as AdminHome;
use App\Http\Controllers\Admin\Master\AccountController;
use App\Http\Controllers\Admin\Master\DriverController;
use App\Http\Controllers\Admin\Master\OrderController;
use App\Http\Controllers\Admin\Master\ScheduleController;
use App\Http\Controllers\Admin\Master\VehicleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Supervisor\ApprovalController;

//SUPERVISOR
use App\Http\Controllers\Supervisor\HomeController as SupervisorHome;

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

Route::get('/', function () {
    return view('pages.auth.login');
})->name('auth.login_view');

Route::post('/auth/login', [AuthController::class, 'login'])->name('auth.login');
Route::get('/auth/logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::prefix('admin')->group(function () {
    Route::get('home', [AdminHome::class, 'index'])->name('admin.home');

    Route::prefix('order')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('admin.order.index');
        Route::post('/insert', [OrderController::class, 'insert'])->name('admin.order.insert');
        Route::put('/{id}', [OrderController::class, 'update'])->name('admin.order.update');
        Route::delete('/{id}', [OrderController::class, 'delete'])->name('admin.order.delete');
        Route::get('/export', [OrderController::class, 'export'])->name('admin.order.export');
        Route::get('/test', function () {
            return view('exports.order-export');
        });
    });

    Route::prefix('master')->group(function () {
        Route::prefix('vehicles')->group(function () {
            Route::get('/', [VehicleController::class, 'index'])->name('admin.master.vehicles');
            Route::post('/', [VehicleController::class, 'insert'])->name('admin.master.vehicles.insert');
            Route::put('/{id}', [VehicleController::class, 'update'])->name('admin.master.vehicles.update');
            Route::delete('/{id}', [VehicleController::class, 'delete'])->name('admin.master.vehicles.delete');
        });

        Route::prefix('drivers')->group(function () {
            Route::get('/', [DriverController::class, 'index'])->name('admin.master.driver');
            Route::post('/', [DriverController::class, 'insert'])->name('admin.master.driver.insert');
            Route::put('/{id}', [DriverController::class, 'update'])->name('admin.master.driver.update');
            Route::delete('/{id}', [DriverController::class, 'delete'])->name('admin.master.driver.delete');
        });

        Route::prefix('schedule')->group(function () {
            Route::get('/', [ScheduleController::class, 'index'])->name('admin.master.schedule');
            Route::post('/', [ScheduleController::class, 'insert'])->name('admin.master.schedule.insert');
            Route::put('/{id}', [ScheduleController::class, 'update'])->name('admin.master.schedule.update');
            Route::delete('/{id}', [ScheduleController::class, 'delete'])->name('admin.master.schedule.delete');
        });

        Route::prefix('account')->group(function () {
            Route::get('/', [AccountController::class, 'index'])->name('admin.master.account');
            Route::post('/', [AccountController::class, 'insert'])->name('admin.master.account.insert');
            Route::put('/{id}/{role}', [AccountController::class, 'update'])->name('admin.master.account.update');
            Route::delete('/{id}/{role}', [AccountController::class, 'delete'])->name('admin.master.account.delete');
        });
    });
});

Route::prefix('supervisor')->group(function () {
    Route::get('home', [SupervisorHome::class, 'index'])->name('supervisor.home');

    Route::prefix('approval')->group(function () {
        Route::get('/', [ApprovalController::class, 'index'])->name('supervisor.approval.index');
        Route::get('/{id}', [ApprovalController::class, 'index'])->name('supervisor.approval.detail');
        Route::get('/approve', [ApprovalController::class, 'index'])->name('supervisor.approval.approve');
    });
});
