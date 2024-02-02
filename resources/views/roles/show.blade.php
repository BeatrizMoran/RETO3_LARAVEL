@extends('layouts.panelAdministracion')

@section('title', 'Ver Rol')

@section('content')
        <div class="row">
            <div class="col-12">
                <div>
                    <h1>Rol: {{ $role->name }}</h1>
                </div>
                <div>
                    <a href="{{ route('roles.edit', $role) }}" class="btn btn-warning">Editar</a>
                    <a href="{{ route('roles.index') }}" class="btn btn-secondary">Regresar a la Lista</a>
                </div>
                <div class="mt-3">
                    <h3>Permisos</h3>
                    <ul>
                        @foreach ($role->permissions as $permission)
                            <li>{{ $permission->name }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
@endsection
