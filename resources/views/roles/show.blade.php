@extends('layouts.panelAdministracion')

@section('title', 'Ver Rol')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10 col-12">
                <h1 class="mb-3">Rol: {{ $role->name }}</h1>
                <div class="mb-4">
                    <a href="{{ route('roles.edit', $role) }}" class="btn btn-warning me-2">Editar</a>
                    <a href="{{ route('roles.index') }}" class="btn btn-secondary">Regresar a la Lista</a>
                </div>
                <div>
                    <h3>Permisos</h3>
                    <ul class="list-group">
                        @forelse ($role->permissions as $permission)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $permission->name }}
                                <span class="badge bg-primary rounded-pill">Permiso</span>
                            </li>
                        @empty
                            <li class="list-group-item">Este rol no tiene permisos asignados.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
