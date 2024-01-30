<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /*   public function __construct()
    {
        // Restringe todas las acciones del controlador a usuarios que tienen el permiso 'role:responsable'
        $this->middleware('role:responsable');

        // O puedes aplicar restricciones específicas a métodos individuales
        // $this->middleware('permission:role:responsable', ['only' => ['create', 'store', 'edit', 'update', 'destroy']]);
        // $this->middleware('permission:view roles', ['only' => ['index', 'show']]);
    } */
    public function index()
    {
        $roles = Role::all();
        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $role = Role::create(['name' => $request->name]);
        $role->syncPermissions($request->permissions);

        return redirect()->route('roles.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        $permissions = Permission::all(); // Obtener todos los permisos

        return view('roles.show', compact('role', 'permissions'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all(); // Obtener todos los permisos

        // Pasar el rol y todos los permisos a la vista
        return view('roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        // Validar los datos del formulario
        $this->validate($request, [
            'name' => 'required|unique:roles,name,' . $role->id,
            'permissions' => 'required',
        ]);

        $role->name = $request->input('name');
        $role->save();

        // Sincronizar los permisos
        $role->syncPermissions($request->input('permissions'));

        return redirect()->route('roles.index')
            ->with('success', 'Rol actualizado exitosamente');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        // Opcional: Verificar si el rol está siendo utilizado antes de eliminarlo
        if ($role->users()->count() > 0) {
            return redirect()->route('roles.index')
                ->with('error', 'No se puede eliminar un rol que está en uso.');
        }

        $role->delete();

        return redirect()->route('roles.index')
            ->with('success', 'Rol eliminado exitosamente');
    }
}
