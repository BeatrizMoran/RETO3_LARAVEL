<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Muestra un listado de las categorías.
     */
    public function index()
    {
        $categorias = Categoria::paginate(10);
        return view('categorias.index', compact('categorias'));
    }

    /**
     * Muestra el formulario para crear una nueva categoría.
     */
    public function create()
    {
        return view('categorias.create');
    }

    /**
     * Guarda una nueva categoría en la base de datos.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nombre' => 'required|',
        ]);

        Categoria::create(['nombre' => $request->input('nombre')]);

        return redirect()->route('categorias.index')
            ->with('success', 'Categoria creada exitosamente');
    }

    /**
     * Muestra una categoría específica.
     */
    public function show(Categoria $categoria)
    {
        return view('categorias.show', compact('categoria'));
    }

    /**
     * Muestra el formulario de edición para una categoría existente.
     */
    public function edit(Categoria $categoria)
    {
        return view('categorias.edit', compact('categoria'));
    }

    /**
     * Actualiza una categoría en la base de datos.
     */
    public function update(Request $request, Categoria $categoria)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|max:255',
            // otros campos de validación
        ]);

        $categoria->update($validatedData);
        return redirect()->route('categorias.index');
    }

    /**
     * Elimina una categoría de la base de datos.
     */
    public function destroy(Categoria $categoria)
    {
        $categoria->delete();
        return redirect()->route('categorias.index');
    }

    /**
     * Devuelve todas las categorías en formato JSON.
     */
    public function categoriasAPI()
    {
        $categorias = Categoria::all();
        return response()->json($categorias);
    }
}
