@extends('layouts.panelAdministracion')

@section('title', 'Página Específica')

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <h1>Detalles pedido</h1>
    @if (auth()->user()->hasRole('responsable') ||
            auth()->user()->hasRole('administrativo'))
        <!-- Comercial no puede crear productos -->
        <a href="{{ route('pedidos.edit', $pedido) }}" class="btn btn-primary mb-3">Editar</a>
    @endif
    <a href="{{ route('pedidos.index') }}" class="btn btn-secondary mb-3">Volver</a>

    <form action="{{ route('pedidos.update', $pedido) }}" method="POST">
        @csrf
        @method("PUT")
        <!-- Nombre del Cliente -->
        <div class="mb-3">
            <label for="nombreCliente" class="form-label">Nombre del Cliente</label>
            <select name="cliente" @if (!$edit) readonly @endif>
                @foreach ($clientes as $cliente)
                    <option value="{{ $cliente->id }}" {{ $cliente->id == $pedido->cliente->id ? 'selected' : '' }}>
                        {{ $cliente->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div id="productosContainer" class="mb-3">
            <div class="row mb-2 producto-row">
                <div class="col-5">
                    @foreach ($pedido->productos as $producto)
                        <div class="row mb-2 producto-row">
                            <div class="col-5">
                                <select class="form-select" name="producto[]" @if (!$edit) readonly @endif>
                                    <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
                                </select>
                            </div>
                            <div class="col-5">
                                <input type="number" class="form-control" name="cantidad[]"
                                    value="{{ $producto->pivot->cantidad }}" placeholder="Cantidad" @if (!$edit) readonly @endif>
                            </div>
                            <div class="col-2">
                                <input type="{{ $edit ? 'button' : 'hidden' }}" class="btn btn-outline-primary mb-2" id="btnEliminarProducto" value="Eliminar">
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="col-md-2">
                    <input type="{{ $edit ? 'button' : 'hidden' }}" class="btn btn-outline-primary mb-2" id="btnAgregarProducto"
                        data-productos="{{ json_encode($productos) }}" value="Añadir producto">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <select name="estado" id="estado" @if (!$edit) readonly @endif>
                    <option value="solicitado" {{ $pedido->estado === 'solicitado' ? 'selected' : '' }}>Solicitado</option>
                    <option value="en preparacion" {{ $pedido->estado === 'en preparacion' ? 'selected' : '' }}>En preparacion</option>
                    <option value="en entrega" {{ $pedido->estado === 'en entrega' ? 'selected' : '' }}>En entrega</option>
                    <option value="entregado" {{ $pedido->estado === 'entregado' ? 'selected' : '' }}>Entregado</option>
                </select>
            </div>
        </div>

        <input type="{{ $edit ? 'submit' : 'hidden' }}" class="btn btn-primary" value="Actualizar pedido">
    </form>

@endsection

@section('footer', '©️ Cervezas Killer')
