<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('roles')->paginate(10);
        return view("users.index", compact("users"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = DB::table('roles')->get();
        return view("users.create", compact("roles"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validación de la solicitud
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:8',
        'roles' => 'required|array', // roles es un array de nombres de roles
    ]);

    // Crear el usuario
    $user = User::create([
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'password' => bcrypt($request->input('password')),
    ]);

    // Asignar roles al usuario usando attach
    $roles = $request->input('roles');
    foreach ($roles as $rol) {
        $roleModel = \Spatie\Permission\Models\Role::where('name', $rol)->first();
        if ($roleModel) {
            $user->roles()->attach($roleModel->id);
        }
    }

    // Puedes retornar una respuesta de éxito si lo deseas
    return redirect()->route('usuarios.index')->with('success', 'Usuario creado con éxito');
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */

public function destroy($id)
{
    //comprobar que no sea el usuario con el que esta logueado
    $user = User::find($id);

    if ($user) {
        $user->delete();
        session()->flash('success', 'usuario borrado correctamente');
    } else {
        session()->flash('error', 'usuario no encontrado');
    }

    return redirect()->back();
}


}
