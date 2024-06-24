<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SectorController;
use App\Http\Controllers\TipoProdutosController;
use App\Http\Controllers\TipoSetoresController;
use App\Http\Controllers\WorkspaceController;
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

Route::get('/', function () {
    return view('welcome');
});



Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::resource('/workspaces', WorkspaceController::class);
    Route::resource('/sectors', SectorController::class);
    Route::resource('/products', ProductController::class);
    Route::resource('/typeSector', TipoSetoresController::class);
    Route::resource('/productsTypes', TipoProdutosController::class);
});



require __DIR__.'/auth.php';
