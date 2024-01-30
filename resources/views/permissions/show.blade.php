@extends('layouts.panelAdministracion')

@section('title', 'Ver Permiso')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <h1>Permiso: {{ $permission->name }}</h1>
            <div>
                <a href="{{ route('permissions.edit', $permission) }}" class="btn btn-warning">Editar</a>
                <a href="{{ route('permissions.index') }}" class="btn btn-secondary">Regresar a la Lista</a>
            </div>
        </div>
    </div>
</div>
@endsection
