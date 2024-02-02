@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <h1>Editar Cliente</h1>
        <form action="{{ route('clientes.update', $cliente) }}" method="POST" class="needs-validation" novalidate>
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="codigo_cliente" class="form-label">Código del Cliente</label>
                <input type="text" class="form-control" id="codigo_cliente" name="codigo_cliente"
                    value="{{ $cliente->codigo_cliente }}" readonly required>
                <div class="invalid-feedback">
                    Por favor ingresa un código de cliente válido.
                </div>
            </div>
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $cliente->nombre }}"
                    required>
                <div class="invalid-feedback">
                    Por favor ingresa un nombre.
                </div>
            </div>
            <div class="mb-3">
                <label for="direccion" class="form-label">Dirección</label>
                <input type="text" class="form-control" id="direccion" name="direccion" value="{{ $cliente->direccion }}"
                    required>
                <div class="invalid-feedback">
                    Por favor ingresa una dirección.
                </div>
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="text" class="form-control" id="telefono" name="telefono" value="{{ $cliente->telefono }}"
                    required>
                <div class="invalid-feedback">
                    Por favor ingresa un número de teléfono válido.
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
</div>

@endsection
