<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TelegramBotController;
use App\Http\Controllers\ReportSalesController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get(
    'report-sales/export',
    [ReportSalesController::class, 'export']
)->name('report-sales.export');

Route::resource('report-sales', ReportSalesController::class)
    ->only(['index']);

Route::resource('report-sales', ReportSalesController::class)
    ->only(['index']);
/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'index'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.process');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');
    
Route::post('/telegram/webhook', [TelegramBotController::class, 'webhook'])
    ->name('telegram.webhook');

/*
|--------------------------------------------------------------------------
| Protected Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

   Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | Master Data
    |--------------------------------------------------------------------------
    */

    Route::resource('roles', RoleController::class);

    Route::resource('users', UserController::class);

    /*
    |--------------------------------------------------------------------------
    | Site
    |--------------------------------------------------------------------------
    */

    Route::post('/sites/import', [SiteController::class, 'import'])
        ->name('sites.import');

    Route::resource('sites', SiteController::class);

    /*
    |--------------------------------------------------------------------------
    | Monitoring
    |--------------------------------------------------------------------------
    */

    // Route::resource('selling', SellingController::class);

});