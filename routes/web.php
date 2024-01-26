<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductoController;
use Illuminate\Support\Facades\Auth;
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
})->name('welcome');

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Route::get('/home', [ProductoController::class, 'index'])->name('productos.index');



Route::get('/productos', [ProductoController::class, 'catalogo'])->name('productos.catalogo');

Route::middleware(['role:responsable'])->group(function () {
    Route::get('/dashboard', [ProductoController::class, 'dashboard'])->name('dashboard');
    Route::get('/register', [RegisterController::class, 'dashboard'])->name('dashboard');

    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes.index');

        Route::prefix('productos')->name('productos.')->group(function () {
            Route::get('/', [ProductoController::class, 'dashboardProductos'])->name('index');
            Route::get('/create', [ProductoController::class, 'create'])->name('create');
            Route::post('/store', [ProductoController::class, 'store'])->name('store');
            Route::delete('/destroy/{producto}', [ProductoController::class, 'destroy'])->name('destroy');
        });
    });
});
