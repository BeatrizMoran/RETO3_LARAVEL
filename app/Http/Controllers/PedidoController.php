<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Pedido;
use App\Models\Producto;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PedidoRequest;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use ConsoleTVs\Charts\Commands\ChartsCommand;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pedidos = Pedido::with(['cliente', 'productos', "users"])->paginate(10);

        return view('pedidos.dashboard', compact('pedidos'));
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


    public function calcularTotalPedido($pedidoId)
    {
        // Obtén el pedido deseado
        $pedido = Pedido::findOrFail($pedidoId);

        // Inicializa una variable para el total
        $total = 0;

        // Recorre los productos del pedido y suma sus precios multiplicados por la cantidad
        foreach ($pedido->productos as $producto) {
            $total += $producto->precio * $producto->pivot->cantidad;
        }

        // Actualiza el campo 'total' del pedido con el valor calculado
        $pedido->total = $total;
        $pedido->save();

        // Redirige de regreso a la vista del pedido o a donde desees
        return redirect()->route('pedidos.show', $pedido);
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
            'total' => 0,
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
        $this->calcularTotalPedido($pedido->id);

        // Obtener el usuario actual autenticado
        $usuarioActual = Auth::user();

        // Adjuntar el usuario al pedido
        $pedido->users()->attach($usuarioActual->id);

        $pedidos = Pedido::with(['cliente', 'productos', "users"])->paginate(10);


        session()->flash('success', 'Pedido creado correctamente');


        // Puedes retornar una respuesta de éxito si lo deseas
        return redirect()->route('pedidos.index', compact("pedidos"));
    }
    /**
     * Display the specified resource.
     */
    public function show(Pedido $pedido)
    {
        // Cargar relaciones necesarias para evitar consultas adicionales
        $pedido->load('cliente', 'users', 'productos');

        $clientes = Cliente::all();
        $productos = Producto::all();

        return view("pedidos.show", [
            "clientes" => $clientes,
            "productos" => $productos,
            "pedido" => $pedido,
            "edit" => false
        ]);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pedido $pedido)
    {
        $pedido->load('cliente', 'users', 'productos');

        $clientes = Cliente::all();
        $productos = Producto::all();

        return view("pedidos.show", [
            "clientes" => $clientes,
            "productos" => $productos,
            "pedido" => $pedido,
            "edit" => true
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pedido $pedido)
    {
        // Validación de la solicitud
        $request->validate([
            'cliente' => 'required|exists:clientes,id',
            'producto' => 'required|array',
            'producto.*' => 'exists:productos,id',
            'cantidad' => 'required|array',
            'cantidad.*' => 'required|integer|min:1',
            'estado' => 'required|in:solicitado,en preparacion,en entrega,entregado',
        ]);

        // Actualizar los datos básicos del pedido
        $pedido->update([
            'cliente_id' => $request->input('cliente'),
            'estado' => $request->input('estado'),
        ]);

        // Sincronizar productos y cantidades
        $productos = $request->input('producto');
        $cantidades = $request->input('cantidad');

        $productosConCantidad = [];
        foreach ($productos as $index => $productoId) {
            $productosConCantidad[$productoId] = ['cantidad' => $cantidades[$index]];
        }

        $pedido->productos()->sync($productosConCantidad);
        $this->calcularTotalPedido($pedido->id);

        // Actualizar la relación con el usuario actual (asumo que estás utilizando el modelo User para la autenticación)
        $usuarioActual = Auth::user();
        $pedido->users()->sync([$usuarioActual->id]);

        // Puedes retornar una respuesta de éxito si lo deseas
        return redirect()->route('pedidos.show', $pedido)->with('success', 'Pedido actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pedido $pedido)
    {
        $pedido->delete();

        session()->flash('danger', 'Pedido borrado correctamente');

        return redirect()->back();
    }

    public function graficaPedidos()
    {
        $pedidos = Pedido::selectRaw('sum(total) as total, date(created_at) as date')
            ->groupBy('date')
            ->get();
    
        $dates = $pedidos->pluck('date');
        $totals = $pedidos->pluck('total');
    
        return view('pedidos.grafica', compact('dates', 'totals'));
    }
    
}
