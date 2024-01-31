@extends('layouts.panelAdministracion')

@section('title', 'Editar Rol')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10 col-12">
                <h1 class="mb-3">Editar Rol: {{ $role->name }}</h1>
                <form action="{{ route('roles.update', $role) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre del Rol</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $role->name }}"
                            required>
                    </div>

                    <div class="mb-3">
                        <h3>Permisos</h3>
                        <div class="card">
                            <div class="card-body">
                                @foreach ($permissions as $permission)
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" name="permissions[]"
                                            value="{{ $permission->name }}" id="permission_{{ $permission->id }}"
                                            {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="permission_{{ $permission->id }}">
                                            {{ $permission->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success">Guardar Cambios</button>
                    <a href="{{ url()->previous() }}" class="btn btn-primary">Cancelar</a>

                </form>
            </div>
        </div>
    </div>
@endsection
