<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ProductoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//imagenes pedidos
Route::get('/images/{filename}', function ($filename) {
    $path = storage_path('app/public/images/' . $filename);

    if (!Storage::exists('public/images/' . $filename)) {
        abort(404);
    }

    $file = Storage::get('public/images/' . $filename);
    $type = Storage::mimeType('public/images/' . $filename);

    $response = response($file, 200)->header("Content-Type", $type);

    return $response;
})->name('image.show');

Route::get('/productos', [ProductoController::class, 'buscarProductos']);

Route::get('/pedidos', [PedidoController::class, 'pedidosCliente']);

Route::get('/cliente', [ClienteController::class, 'comprobarCliente']);

Route::get('/categorias', [CategoriaController::class, 'categoriasAPI']);
