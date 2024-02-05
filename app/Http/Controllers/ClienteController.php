<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Pedido;
use App\Notifications\ClienteCreadoNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Cliente::paginate(10);
        return view("clientes.index", compact("clientes"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'codigo_cliente' => 'required|unique:clientes,codigo_cliente|max:255',
            'email' => 'required|unique:clientes,email|max:255',
            'nombre' => 'required|max:255',
            'direccion' => 'required|max:255',
            'telefono' => 'required|max:255'
        ]);

        $validatedData['codigo_cliente'] = Crypt::encrypt($validatedData['codigo_cliente']);
        $cliente = Cliente::create($validatedData);
        //$cliente->notify(new ClienteCreadoNotification($cliente));
        session()->flash('success', 'Cliente creado correctamente');

        return redirect()->route('clientes.index');
    }


    /**
     * Display the specified resource.
     */
    public function show(Cliente $cliente)
    {
        return view('clientes.show', compact('cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cliente $cliente)
    {
        return view('clientes.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cliente $cliente)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|max:255',
            'direccion' => 'required|max:255',
            'telefono' => 'required|max:255' // Puedes agregar validaciones adicionales para el teléfono si es necesario
        ]);




        $cliente->update($validatedData);

        session()->flash('success', 'Cliente actualizado correctamente');
        return redirect()->route('clientes.show', $cliente)->with('success', 'Cliente actualizado exitosamente');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $cliente)
    {
        $cliente->delete();

        session()->flash('danger', 'Cliente borrado correctamente');

        return redirect()->back();
    }

    //api

    public function comprobarCliente(Request $request)
    {
        $request->validate([
            'codigo_cliente' => 'required',
        ]);

        $codigo_cliente_no_cifrado = $request->input('codigo_cliente');
        $clientes = Cliente::all();

        // Buscar entre todos los clientes
        foreach ($clientes as $cliente) {
            // Desencriptar el código almacenado y verificar si coincide
            $codigo_cliente_cifrado = $cliente->codigo_cliente;
            $codigo_cliente_desencriptado = Crypt::decrypt($codigo_cliente_cifrado);

            if ($codigo_cliente_no_cifrado === $codigo_cliente_desencriptado) {
                return response()->json($cliente);
            }
        }

        // Si no se encuentra ningún cliente con el código proporcionado
        return response()->json(['error' => 'Cliente no encontrado para el código especificado'], 404);
    }

    public function actualizarCliente(Request $request, $id)
    {
        $cliente = Cliente::find($id);

        if (!$cliente) {
            return response()->json(['error' => 'Cliente no encontrado'], 404);
        }

        $request->validate([
            'codigo_cliente' => 'unique:clientes,codigo_cliente,' . $cliente->id,
            'nombre' => 'required|string',
            'direccion' => 'required|string',
            'telefono' => 'required|string',
        ]);

        // Cifrar el nuevo código de cliente antes de actualizar
        $request->merge([
            'codigo_cliente' => Crypt::encrypt($request->input('codigo_cliente')),
        ]);

        // Actualizar los datos del cliente
        $cliente->update($request->all());

        return response()->json(['mensaje' => 'Cliente actualizado con éxito']);
    }
}
