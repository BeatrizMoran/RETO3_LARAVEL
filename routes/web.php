<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProductoController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Auth::routes();

Route::get('/catalogo', [ProductoController::class, 'catalogo'])->name('productos.catalogo');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [ProductoController::class, 'dashboard'])->name('dashboard');
});
Route::middleware(['role:responsable'])->group(function () {

    Route::get('/dashboard/productos', [ProductoController::class, 'dashboardProductos'])->name('dashboard.productos');


    Route::resource('/productos', ProductoController::class);

    Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes.index');
    Route::resource('/clientes', ClienteController::class);

});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
