<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    return view('welcome');
})->name('welcome');






Auth::routes(['verify' => true]);

Route::get('/catalogo', [ProductoController::class, 'catalogo'])->name('productos.catalogo');
Route::get('/buscar-productos', [ProductoController::class, 'buscarProductos'])->name('buscar.productos');


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [ProductoController::class, 'dashboard'])->name('dashboard');
    Route::put('/perfil/update/{user}', [UserProfileController::class, 'update'])->name('perfil.update');

    Route::get('/perfil', function () {
        return view('perfil');
    })->name('perfil');

    Route::get('/perfil/edit', [UserController::class, 'perfilEdit'])->name('perfil.edit');

    Route::put('/perfil/update', [UserController::class, 'update'])->name('perfil.update');


});

Route::middleware(['role:responsable|comercial|administrativo'])->group(function () {

    Route::get('/productos/show/{producto}', [ProductoController::class, 'show'])->name('productos.show');
    Route::get('/dashboard/productos', [ProductoController::class, 'dashboardProductos'])->name('dashboard.productos');
    Route::get('/pedidos', [PedidoController::class, 'index'])->name('pedidos.index');
    Route::get('/pedidos/show/{pedido}', [PedidoController::class, 'show'])->name('pedidos.show');
});

Route::middleware(['role:responsable|comercial'])->group(function () {

    Route::get('/pedidos/create', [PedidoController::class, 'create'])->name('pedidos.create');
    Route::post('/pedidos/store', [PedidoController::class, 'store'])->name('pedidos.store');
    Route::delete('/pedidos/destroy/{pedido}', [PedidoController::class, 'destroy'])->name('pedidos.destroy');
    Route::get('/pedidos/edit/{pedido}', [PedidoController::class, 'edit'])->name('pedidos.edit');
    Route::put('/pedidos/update/{pedido}', [PedidoController::class, 'update'])->name('pedidos.update');
});


Route::middleware(['role:responsable|administrativo'])->group(function () {

    Route::get('/productos/edit/{producto}', [ProductoController::class, 'edit'])->name('productos.edit');
    Route::put('/productos/update/{producto}', [ProductoController::class, 'update'])->name('productos.update');

    Route::get('/productos/create', [ProductoController::class, 'create'])->name('productos.create');
    Route::post('/productos/store', [ProductoController::class, 'store'])->name('productos.store');
    Route::delete('/productos/destroy/{producto}', [ProductoController::class, 'destroy'])->name('productos.destroy');

    Route::resource('/clientes', ClienteController::class);
    Route::resource('/permisos', PermissionController::class);
});


Route::middleware(['role:responsable'])->group(function () {
    Route::get('/pedidos/grafica', [PedidoController::class, 'graficaPedidos'])->name('pedidos.grafica');
    Route::resource('/usuarios', UserController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('/permissions', PermissionController::class);
    Route::resource('/categorias', CategoriaController::class);

});


Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
