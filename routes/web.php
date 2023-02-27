<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InstrumenController;
use App\Http\Controllers\DistribusiController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/sebaran', [InstrumenController::class, 'sebaran'])->name('sebaran');
    Route::get('/instrumen', [InstrumenController::class, 'index'])->name('instrumen.index');
    Route::get('/distribusi', [DistribusiController::class, 'index'])->name('distribusi.index');
    Route::get('/distribusi/{kode_instrument}', [DistribusiController::class, 'show'])->name('distribusi.show');

    Route::get('/tekanan', function () {
        return view('tekanan');
    })->name('tekanan');
});

require __DIR__ . '/auth.php';
