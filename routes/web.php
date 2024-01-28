<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\HomeController;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/perfil', function () {
    return view('perfil');
})->name('perfil');

Route::post('/toggle-dark-mode', [HomeController::class, "modoClaroOscuro"])->name('toggle-dark-mode');


Auth::routes();

Route::get('/catalogo', [ProductoController::class, 'catalogo'])->name('productos.catalogo');

Route::get('/dashboard/profile', function (){
    return view("profile");
})->name("profile");


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [ProductoController::class, 'dashboard'])->name('dashboard');
});
Route::middleware(['role:responsable'])->group(function () {

    Route::get('/dashboard/productos', [ProductoController::class, 'dashboardProductos'])->name('dashboard.productos');


    Route::resource('/productos', ProductoController::class);

    Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes.index');
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
