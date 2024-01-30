<?php
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    return view('welcome');
})->name('welcome');


Route::post('/toggle-dark-mode', [HomeController::class, "modoClaroOscuro"])->name('toggle-dark-mode');


Auth::routes();


Route::get('/catalogo', [ProductoController::class, 'catalogo'])->name('productos.catalogo');


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [ProductoController::class, 'dashboard'])->name('dashboard');

    Route::get('/perfil', function () {
        return view('perfil');
    })->name('perfil');


    Route::get('/productos/dashboardProductos', [ProductoController::class, 'dashboardProductos'])->name('productos.dashboardProductos');
    Route::get('/productos/show/{producto}', [ProductoController::class, 'show'])->name('productos.show');
    Route::get('/dashboard/productos', [ProductoController::class, 'dashboardProductos'])->name('dashboard.productos');





    Route::get('/pedidos', [PedidoController::class, 'index'])->name('pedidos.index');
    Route::get('/pedidos/show/{pedido}', [PedidoController::class, 'show'])->name('pedidos.show');
    Route::get('/pedidos/edit/{pedido}', [PedidoController::class, 'edit'])->name('pedidos.edit');
    Route::put('/pedidos/update/{pedido}', [PedidoController::class, 'update'])->name('pedidos.update');




});


Route::middleware(['role:responsable|comercial'])->group(function () {


    Route::get('/productos/edit/{producto}', [ProductoController::class, 'edit'])->name('productos.edit');
    Route::put('/productos/update/{producto}', [ProductoController::class, 'update'])->name('productos.update');





    Route::get('/pedidos/create', [PedidoController::class, 'create'])->name('pedidos.create');
    Route::post('/pedidos/store', [PedidoController::class, 'store'])->name('pedidos.store');
    Route::delete('/pedidos/destroy/{id}', [PedidoController::class, 'destroy'])->name('pedidos.destroy');
});


Route::middleware(['role:responsable|administrativo'])->group(function () {
    Route::get('/productos/create', [ProductoController::class, 'create'])->name('productos.create');
    Route::post('/productos/store', [ProductoController::class, 'store'])->name('productos.store');
    Route::delete('/productos/destroy/{producto}', [ProductoController::class, 'destroy'])->name('productos.destroy');
    Route::resource('/clientes', ClienteController::class);
});


Route::middleware(['role:responsable'])->group(function () {
    Route::resource('/usuarios', UserController::class);
});


Route::post('/logout', [LoginController::class, 'logout'])->name('logout');



