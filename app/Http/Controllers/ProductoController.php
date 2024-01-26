<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Pedido;
use App\Models\Producto;
use Illuminate\Http\Request;
use App\Http\Requests\ProductoRequest;


class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function catalogo()
    {
        $productos = Producto::with('categorias')->get();
        return view("productos.catalogo", compact("productos"));
    }

   /*  public function index()
    {
        $productos = Producto::with('categorias')->get();
        return view("productos.catalogo", compact("productos"));
    } */

    public function productosAPI()
    {
        $productos = Producto::all();
        return response()->json($productos);
    }

    public function dashboard()
    {
        return view("dashboard");
    }

    public function dashboardProductos()
    {
        $productos = Producto::with('categorias')->paginate(10);

        return view("productos.dashboard", compact("productos"));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Categoria::all();
        return view("productos.create", compact("categorias"));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductoRequest $request)
    {

        //excluir el campo categorias de la request
        $datosProducto = $request->except('categorias');
        $producto = Producto::create($datosProducto);


        // Obtener las categorías seleccionadas del formulario
        $categoriasSeleccionadas = $request->input('categorias', []);

        // Asociar las categorías al producto
        $producto->categorias()->attach($categoriasSeleccionadas);

        $totalPages = Producto::with('categorias')->paginate(10)->lastPage();

        session()->flash('success', 'Producto creado correctamente');

        return redirect(route('dashboard.productos', ['page' => $totalPages]));
    }
    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductoRequest $request, Producto $producto)
    {
        $producto->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        $producto->delete();

        $totalPages = Producto::with('categorias')->paginate(10)->lastPage();

        session()->flash('danger', 'Producto borrado correctamente');
        return redirect(route('dashboard.productos', ['page' => $totalPages]));

    }



}
