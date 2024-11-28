<?php

use Illuminate\Support\Facades\Route;
use Modules\TomatoLogs\App\Http\Controllers\TomatoLogsController;

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


Route::middleware(['web', 'splade', 'verified'])->name('admin.')->group(function () {
    Route::get('admin/logs', [\Modules\TomatoLogs\App\Http\Controllers\LogsController::class, 'index'])->name('logs.index');
    Route::get('admin/logs/file/{record}', [\Modules\TomatoLogs\App\Http\Controllers\LogsController::class, 'file'])->name('logs.file');
    Route::get('admin/logs/{record}', [\Modules\TomatoLogs\App\Http\Controllers\LogsController::class, 'show'])->name('logs.show');
    Route::delete('admin/logs/{record}', [\Modules\TomatoLogs\App\Http\Controllers\LogsController::class, 'destroy'])->name('logs.destroy');
});
