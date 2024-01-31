@extends('layouts.panelAdministracion')

@section('content')
    <div class="container">
        <h1 class="mb-4">Detalle del Cliente</h1>

        <div class="card">
            <div class="card-header">
                Información del Cliente
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-4">Código del Cliente:</dt>
                    <dd class="col-sm-8">{{ Crypt::decrypt($cliente->codigo_cliente) }}</dd>

                    <dt class="col-sm-4">Nombre:</dt>
                    <dd class="col-sm-8">{{ $cliente->nombre }}</dd>

                    <dt class="col-sm-4">Dirección:</dt>
                    <dd class="col-sm-8">{{ $cliente->direccion }}</dd>

                    <dt class="col-sm-4">Teléfono:</dt>
                    <dd class="col-sm-8">{{ $cliente->telefono }}</dd>
                </dl>
            </div>
        </div>

        <div class="mt-4">
            <a href="{{ route('clientes.index') }}" class="btn btn-secondary me-2">Volver</a>
            <a href="{{ route('clientes.edit', $cliente) }}" class="btn btn-primary">Editar</a>
        </div>
    </div>
@endsection
