<?php

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
});

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Route::get('/home', [ProductoController::class, 'index'])->name('productos.index');

Route::get('/', [ProductoController::class, 'index'])->name('productos.index');

Route::get('/dashboard', [ProductoController::class, 'dashboard'])->name('dashboard');

Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes.index');

Route::get('/dashboard/productos', [ProductoController::class, 'dashboardProductos'])->name('dashboard.productos');


