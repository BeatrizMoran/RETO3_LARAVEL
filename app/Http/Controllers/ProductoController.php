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
    public function index()
{
    $productos = Producto::with('categorias')->get();
    return view("producto.catalogo", compact("productos"));
}


    public function productosAPI()
    {
        $productos = Producto::all();
        return response()->json($productos);
    }

    public function dashboard()
    {
        return view("panelAdministracion");
    }

    public function dashboardProductos()
    {
        $productos = Producto::with('categorias')->paginate(10);

        return view("producto.index", compact("productos"));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("producto.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductoRequest $request)
    {
        //la validacion se hace mediante un custom request

        // Insertar el artículo en la BBDD tras su validación.
        Producto::create($request->all());
        session()->flash('success', 'Producto creado correctamente');


        return redirect(route('dashboard.productos'));
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
        //
    }


}
