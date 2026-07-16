<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SiteController;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard.index');
})->name('dashboard');

/*
|--------------------------------------------------------------------------
| Master Data
|--------------------------------------------------------------------------
*/

Route::resource('roles', RoleController::class);

/*
|--------------------------------------------------------------------------
| Site
|--------------------------------------------------------------------------
*/

Route::post('/sites/import', [SiteController::class, 'import'])
    ->name('sites.import');

Route::resource('sites', SiteController::class);