@extends('layouts.panelAdministracion')

@section('title', 'Permisos')

@section('content')
    <div class="row">
        <div class="col-12 d-flex justify-content-center align-items-center my-3">
            <div class="card my-4 shadow-lg  px-5">
                <div class="card-header p-0 position-relative mx-3 z-index-2" style="margin-top: -1.5rem;">
                    <div
                        class="bg-gradient-primary bg-dark rounded-3 shadow-lg border-radius-lg pt-4 pb-3 d-flex justify-content-between">
                        <h6 class="text-white text-capitalize ps-3">Tabla clientes</h6>
                        @role('responsable|administrativo')
                            <a href="{{ route('productos.create') }}" class="btn btn-success btn-md bg-gradient mb-3 mx-3">
                                <i class="fa-solid fa-plus"></i><span class="mx-3">Añadir cliente</span>
                            </a>
                        @endrole

                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table table-striped table-hover align-items-center mb-0 p-4 text-center">
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
                                            <form action="{{ route('permissions.destroy', $permission) }}" method="POST"
                                                style="display: inline-block;">
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
@endsection
