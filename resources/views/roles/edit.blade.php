@extends('layouts.panelAdministracion')

@section('title', 'Editar Rol')

@section('content')
    <div class="row">
        <div class="col-12">
            <div>
                <h1>Editar Rol: {{ $role->name }}</h1>
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
                        @foreach ($permissions as $permission)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="permissions[]"
                                    value="{{ $permission->name }}" id="permission_{{ $permission->id }}"
                                    {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                                <label class="form-check-label" for="permission_{{ $permission->id }}">
                                    {{ $permission->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                    <button type="submit" class="btn btn-success">Guardar</button>
                </form>
            </div>

        </div>
    </div>
@endsection
