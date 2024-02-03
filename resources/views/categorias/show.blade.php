@extends('layouts.panelAdministracion')

@section('title', 'Ver categoria')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title">Permiso: {{ $permission->name }}</h1>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <a href="{{ route('permissions.edit', $permission) }}" class="btn btn-warning">Editar</a>
                        <a href="{{ route('permissions.index') }}" class="btn btn-secondary">Regresar a la Lista</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
