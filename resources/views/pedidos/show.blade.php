@extends('layouts.panelAdministracion')

@section('title', 'Página Específica')

@section('content')

    <div class="row">
        <div class="col-12">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <h1 class="mb-4">Detalles del pedido</h1>

        <div class="mb-4">
            <a href="{{ route('pedidos.edit', $pedido) }}" class="btn btn-primary mb-3">Editar</a>
            <a href="{{ $edit ? route('pedidos.show', $pedido) : route('pedidos.index') }}" class="btn btn-secondary mb-3">Volver</a>
        </div>

            <form action="{{ route('pedidos.update', $pedido) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nombreCliente" class="form-label">Nombre del Cliente</label>
                    <select name="cliente" class="form-select" {{ $edit ? 'required' : 'disabled' }}>
                        @foreach ($clientes as $cliente)
                            <option value="{{ $cliente->id }}"
                                {{ $cliente->id == $pedido->cliente->id ? 'selected' : '' }}>
                                {{ $cliente->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <input type="{{ $edit ? 'button' : 'hidden' }}" class="btn btn-outline-primary mb-2 btnAgregarProducto"
                        id="btnAgregarProducto" data-productos="{{ json_encode($productos) }}" value="Añadir producto">
                </div>
                <div id="productosContainer"
                    class="mb-3 border p-3 d-flex flex-column align-items-center justify-content-center">

                    <label class="fw-bold fs-4">Productos</label>

                    @foreach ($pedido->productos as $producto)
                        <div class="col-md-6 p-3">
                            <div class="row mb-4 producto-row align-items-center">
                                <div class="col-6">
                                    <select class="form-select" name="producto[]" {{ $edit ? 'required' : 'disabled' }}>
                                        <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <input type="number" class="form-control" name="cantidad[]"
                                        value="{{ $producto->pivot->cantidad }}" placeholder="Cantidad"
                                        {{ $edit ? 'required' : 'disabled' }}>
                                </div>
                                <div class="col-12 mt-3">
                                    <div class="row align-items-center">
                                        <div class="col-6">
                                            <label class="fw-bold">Precio:</label>
                                            <span class="badge bg-success">{{ $producto->precio }}</span>
                                        </div>
                                        <div class="col-6">
                                            <label class="fw-bold">Total:</label>
                                            <span
                                                class="badge bg-primary">{{ $producto->precio * $producto->pivot->cantidad }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mt-3">
                                    <input type="{{ $edit ? 'button' : 'hidden' }}"
                                        class="btn btn-outline-primary mb-2 btnEliminarProducto" id="btnEliminarProducto"
                                        value="Eliminar producto">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="col-12">
                    <select name="estado" id="estado" class="form-select" {{ $edit ? 'required' : 'disabled' }}>
                        <option value="solicitado" {{ $pedido->estado === 'solicitado' ? 'selected' : '' }}>Solicitado
                        </option>
                        <option value="en preparacion" {{ $pedido->estado === 'en preparacion' ? 'selected' : '' }}>En
                            preparación</option>
                        <option value="en entrega" {{ $pedido->estado === 'en entrega' ? 'selected' : '' }}>En entrega
                        </option>
                        <option value="entregado" {{ $pedido->estado === 'entregado' ? 'selected' : '' }}>Entregado
                        </option>
                    </select>

                </div>
                <div class="col-2 mb-2 mt-2">
                    <label class="fw-bold">Total pedido:</label>
                    <span class="badge bg-primary">{{ $pedido->total }}</span>
                </div>
                <input type="{{ $edit ? 'submit' : 'hidden' }}" class="btn btn-primary my-2" value="Actualizar pedido">
            </form>

        </div>

    </div>







    @vite(['resources/js/pedido.js'])

@endsection

@section('footer', '©️ Cervezas Killer')
