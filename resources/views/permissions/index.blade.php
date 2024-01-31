@extends('layouts.panelAdministracion')

@section('title', 'Permisos')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card shadow-lg">
                    <div
                        class="card-header bg-gradient-primary bg-dark text-white text-capitalize d-flex justify-content-between">
                        <h6 class="card-title my-3 ps-3">Tabla de Permisos</h6>
                        @role('responsable|administrativo')
                            <a href="{{ route('permissions.create') }}" class="btn btn-success btn-md bg-gradient mb-3 mx-3">
                                <i class="fa-solid fa-plus"></i><span class="mx-3">Agregar Permiso</span>
                            </a>
                        @endrole
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover align-middle mb-0 text-center">
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
                                                <a href="{{ route('permissions.show', $permission) }}"
                                                    class="btn btn-info">Ver</a>
                                                <a href="{{ route('permissions.edit', $permission) }}"
                                                    class="btn btn-warning">Editar</a>
                                                <form action="{{ route('permissions.destroy', $permission) }}"
                                                    method="POST" style="display: inline-block;">
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
            </div>
        </div>
    </div>
@endsection
