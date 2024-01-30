@extends('layouts.panelAdministracion')

@section('title', 'Crear Permiso')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <h1>Crear Nuevo Permiso</h1>
            <form action="{{ route('permissions.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre del Permiso</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <button type="submit" class="btn btn-success">Guardar</button>
                <a href="{{ route('permissions.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</div>
@endsection
