<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Pedido;
use App\Models\Producto;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PedidoRequest; 



class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clientes = Cliente::all();
        $productos = Producto::all();


        return view("pedidos.create", compact("clientes", "productos"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PedidoRequest $request)
    {
        // Validación de la solicitud utilizando la Custom Request
        $validatedData = $request->validated();

        // Crear un nuevo pedido
        $pedido = new Pedido([
            'cliente_id' => $validatedData['cliente'],
            'estado' => 'en preparacion'
            // Otros campos del pedido
        ]);

        $pedido->save();

        // Agregar los detalles del pedido (productos y cantidades)
        for ($i = 0; $i < count($validatedData['producto']); $i++) {
            $producto_id = $validatedData['producto'][$i];
            $cantidad = $validatedData['cantidad'][$i];

            // Aquí asumo que hay una relación de muchos a muchos entre productos y usuarios
            $pedido->productos()->attach([$producto_id => ['cantidad' => $cantidad]]);

            // Puedes hacer lo mismo para cualquier otra relación de muchos a muchos que necesites
        }

        // Obtener el usuario actual autenticado
        $usuarioActual = Auth::user();

        // Adjuntar el usuario al pedido
        $pedido->users()->attach($usuarioActual->id);

        // Puedes retornar una respuesta de éxito si lo deseas
        return response()->json(['message' => 'Pedido creado con éxito'], 201);
    }
    /**
     * Display the specified resource.
     */
    public function show(Pedido $pedido)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pedido $pedido)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pedido $pedido)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pedido $pedido)
    {
        //
    }


}
