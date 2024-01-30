<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Pedido;
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
            'codigo_cliente' => 'required|unique:clientes,codigo_cliente|max:255', // Asegurarse de que el código del cliente sea único en la tabla de clientes
            'nombre' => 'required|max:255',
            'direccion' => 'required|max:255',
            'telefono' => 'required|max:255' // Puedes agregar validaciones adicionales para el teléfono si es necesario
        ]);
        $validatedData['codigo_cliente'] = Crypt::encrypt($validatedData['codigo_cliente']);
        $cliente = Cliente::create($validatedData);

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
            'codigo_cliente' => 'required|max:255|unique:clientes,codigo_cliente,' . $cliente->id, // Ignora el código del cliente actual
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
}
