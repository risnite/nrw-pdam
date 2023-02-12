<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DistribusiController;
use App\Http\Controllers\InstrumenController;
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
    return view('home');
})->name('home');



Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/sebaran', [InstrumenController::class, 'sebaran'])->name('sebaran');
    Route::get('/instrumen', [InstrumenController::class, 'index'])->name('instrumen.index');
    Route::get('/distribusi', [DistribusiController::class, 'index'])->name('distribusi.index');
    Route::get('/distribusi/{kode_instrument}', [DistribusiController::class, 'show'])->name('distribusi.show');

    Route::get('/tekanan', function () {
        return view('tekanan');
    })->name('tekanan');
});

require __DIR__ . '/auth.php';
