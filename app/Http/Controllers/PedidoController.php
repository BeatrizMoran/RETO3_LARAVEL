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
use App\Http\Resources\PedidoResource;


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


        $numero_pedido = $this->generateCodigoPedido();


        // Crear un nuevo pedido
        $pedido = new Pedido([
            'cliente_id' => $validatedData['cliente'],
            'total' => 0,
            'estado' => 'en preparacion',
            "numero_pedido" => $numero_pedido
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


    private function generateCodigoPedido()
    {
        do {
            $numero_pedido = random_int(100000, 999999);
        } while (Pedido::where('numero_pedido', $numero_pedido)->exists());


        return $numero_pedido;
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
        $pedidosPorFecha = Pedido::selectRaw('sum(total) as total, date(created_at) as date')
            ->groupBy('date')
            ->get();

        $dates = $pedidosPorFecha->pluck('date');
        $totals = $pedidosPorFecha->pluck('total');


        $pedidosPorMes = Pedido::selectRaw('sum(total) as total, DATE_FORMAT(created_at, "%Y-%m") as month')
            ->groupBy('month')
            ->get();

        $mesesPedidos = $pedidosPorMes->pluck('month');
        $totalPedidosPorMes = $pedidosPorMes->pluck('total');

        return view('pedidos.grafica', compact('dates', 'totals', 'mesesPedidos', 'totalPedidosPorMes'));
    }




    //api


    public function pedidosCliente(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|numeric',
        ]);


        $cliente_id = $request->input('cliente_id');
        $pedidos = Pedido::with('productos')->where('cliente_id', $cliente_id)->get();


        if ($pedidos->isEmpty()) {
            return response()->json(['message' => 'No se encontraron pedidos para el cliente especificado'], 404);
        }


        return PedidoResource::collection($pedidos);
    }

    public function crearPedido(Request $request)
    {
        $request->validate([
            'estado' => 'required|in:solicitado,en preparacion,en entrega,entregado',
            'total' => 'required|numeric',
            'cliente_id' => 'nullable|exists:clientes,id',
            'productos' => 'required|array',
            'productos.*.id' => 'required|exists:productos,id',
            'productos.*.cantidad' => 'required|integer|min:1',
        ]);

        $numero_pedido = $this->generateCodigoPedido();

        $datosPedido = $request->except('productos');
        $datosPedido['numero_pedido'] = $numero_pedido;

        $pedido = Pedido::create($datosPedido);

        foreach ($request->productos as $producto) {
            // Adjuntar productos al pedido a través de la tabla intermedia
            $pedido->productos()->attach($producto['id'], ['cantidad' => $producto['cantidad']]);
        }

        return response()->json(['mensaje' => 'Pedido creado con éxito', 'pedido' => $pedido], 201);
    }
}
