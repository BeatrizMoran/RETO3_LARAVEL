@extends('layouts.panelAdministracion')

@section('title', 'Permisos')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <h1>Permisos</h1>
            <a href="{{ route('permissions.create') }}" class="btn btn-primary">Crear Permiso</a>
            <table class="table mt-3">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($permissions as $permission)
                        <tr>
                            <td>{{ $permission->name }}</td>
                            <td>
                                <a href="{{ route('permissions.show', $permission) }}" class="btn btn-info">Ver</a>
                                <a href="{{ route('permissions.edit', $permission) }}" class="btn btn-warning">Editar</a>
                                <form action="{{ route('permissions.destroy', $permission) }}" method="POST" style="display: inline-block;">
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
