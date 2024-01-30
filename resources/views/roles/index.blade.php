@extends('layouts.panelAdministracion')

@section('title', 'Roles')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <h1>Roles</h1>
            <a href="{{ route('roles.create') }}" class="btn btn-primary">Crear Rol</a>
            <table class="table mt-3">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                        <tr>
                            <td>{{ $role->name }}</td>
                            <td>
                                <a href="{{ route('roles.show', $role) }}" class="btn btn-info">Ver</a>
                                <a href="{{ route('roles.edit', $role) }}" class="btn btn-warning">Editar</a>
                                <form action="{{ route('roles.destroy', $role) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
