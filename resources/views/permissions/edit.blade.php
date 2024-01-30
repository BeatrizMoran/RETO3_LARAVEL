@extends('layouts.panelAdministracion')

@section('title', 'Editar Permiso')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <h1>Editar Permiso: {{ $permission->name }}</h1>
            <form action="{{ route('permissions.update', $permission) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre del Permiso</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $permission->name }}" required>
                </div>
                <button type="submit" class="btn btn-success">Actualizar</button>
                <a href="{{ route('permissions.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</div>
@endsection
