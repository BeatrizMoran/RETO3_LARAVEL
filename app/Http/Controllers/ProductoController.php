<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Pedido;
use App\Models\Producto;
use Illuminate\Http\Request;
use App\Http\Requests\ProductoRequest;
use App\Http\Resources\ProductoResource;

class ProductoController extends Controller
{

/*     function __construct()
    {
        $this->middleware('role:administrativo|responsable');
    } */
    /**
     * Display a listing of the resource.
     */

    public function catalogo(Request $request)
    {
        $categorias = Categoria::all();
        $productos = Producto::with('categorias');

        $categoriasSeleccionadas = []; // Definir la variable aquí

        if ($request->has('categorias')) {
            $categoriasSeleccionadas = $request->input('categorias');
            $productos->whereHas('categorias', function ($query) use ($categoriasSeleccionadas) {
                $query->whereIn('categorias.id', $categoriasSeleccionadas);
            });
        }

        $productos = $productos->paginate(9);

        return view("productos.catalogo", compact("categorias", "productos", "categoriasSeleccionadas"));
    }



    /*  public function index()
    {
        $productos = Producto::with('categorias')->get();
        return view("productos.catalogo", compact("productos"));
    } */

    public function productosAPI()
    {
       // $productos = Producto::with('categorias')->get();
        return ProductoResource::collection(Producto::all());
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
        //$datosProducto = $request->except('categorias');
        $codigo_referencia = $this->generateUniqueCodigoReferencia();
        $imageName = time() . '.' . $request->imagen->extension();
        $request->imagen->storeAs('images', $imageName, 'public');
        $producto = new Producto([
            'nombre' => $request->input('nombre'),
            'precio' => $request->input('precio'),
            'imagen' => $imageName,
            'formato' => $request->input('formato'),
            'codigo_referencia' => $codigo_referencia,
        ]);

        $producto->save();

        // Obtener las categorías seleccionadas del formulario
        $categoriasSeleccionadas = $request->input('categorias', []);

        // Asociar las categorías al producto
        $producto->categorias()->attach($categoriasSeleccionadas);

        $totalPages = Producto::with('categorias')->paginate(10)->lastPage();

        session()->flash('success', 'Producto creado correctamente');

        return redirect(route('dashboard.productos', ['page' => $totalPages]));
    }

    private function generateUniqueCodigoReferencia(): string
    {
        $codigoReferencia = 'PROD-' . uniqid();

        // Validar si el código de referencia ya existe
        while (Producto::where('codigo_referencia', $codigoReferencia)->exists()) {
            $codigoReferencia = 'PROD-' . uniqid();
        }

        return $codigoReferencia;
    }
    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        $producto = Producto::with('categorias')->find($producto->id);
        $categorias = Categoria::all();

        return view("productos.show", [
            "producto" => $producto,
            "categorias" => $categorias,
            "edit" => false
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        $producto = Producto::with('categorias')->find($producto->id);

        $categorias = Categoria::all();
        return view("productos.show", [
            "producto" => $producto,
            "categorias" => $categorias,
            "edit" => true
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductoRequest $request, Producto $producto)
    {
        // Obtener las categorías seleccionadas del formulario
        $categoriasSeleccionadas = $request->input('categorias', []);

        // Comprobar si el campo categorias está vacío
        if (empty($categoriasSeleccionadas)) {
            return redirect()->back()->withErrors(['categorias' => 'Debes seleccionar al menos una categoría.'])->withInput();
        }

        // Excluir el campo categorias e imagen de la request
        $datosProducto = $request->except(['categorias', 'imagen']);

        // Actualizar los datos del producto excepto la imagen
        $producto->update($datosProducto);

        // Si se proporciona una nueva imagen, almacenarla y actualizar la propiedad 'imagen'
        if ($request->hasFile('imagen')) {
            $imageName = time() . '.' . $request->imagen->extension();
            $request->imagen->storeAs('images', $imageName, 'public');
            $producto->imagen = $imageName;
            $producto->save();
        }

        // Sincronizar las categorías del producto
        $producto->categorias()->sync($categoriasSeleccionadas);

        session()->flash('success', 'Producto actualizado correctamente');

        return redirect()->route('productos.show', $producto);
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {

        $producto->delete();

        session()->flash('danger', 'Producto borrado correctamente');

        return redirect()->back();
    }

    //api

    public function buscarProductos(Request $request)
    {
        return ProductoResource::collection(Producto::all());

    }
}
