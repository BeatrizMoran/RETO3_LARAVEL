@extends('layouts.panelAdministracion')

@section('title', 'Página Específica')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Realizar Pedido</h1>

        <form action="{{ route('pedidos.store') }}" method="POST">
            @csrf
            <!-- Nombre del Cliente -->
            <div class="mb-3">
                <label for="nombreCliente" class="form-label">Nombre del Cliente</label>
                <select name="cliente" class="form-select">
                    @foreach ($clientes as $cliente)
                        <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Contenedor para productos y cantidades -->
            <div id="productosContainer" class="mb-3">
                <label for="productos" class="form-label">Productos y Cantidades</label>

                <!-- Primer conjunto de productos y cantidades -->
                <div class="row mb-2 producto-row">
                    <div class="col-md-6">
                        <select class="form-select" name="producto[]" required>
                            @foreach ($productos as $producto)
                                <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <input type="number" class="form-control" name="cantidad[]" placeholder="Cantidad" required>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-outline-primary mb-2" id="btnAgregarProducto"
                            data-productos="{{ json_encode($productos) }}">Añadir Producto</button>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Crear Pedido</button>
                <a href="{{ route('pedidos.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>

    @vite(['resources/js/pedido.js'])

@endsection

@section('footer', '©️ Cervezas Killer')
