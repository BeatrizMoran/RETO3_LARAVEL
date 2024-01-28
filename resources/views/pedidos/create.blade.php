@extends('layouts.panelAdministracion')

@section('title', 'Página Específica')

@section('content')
<h1 class="mb-4">Realizar Pedido</h1>

<form action="{{route("pedidos.store")}}" method="POST">
    @csrf
    <!-- Nombre del Cliente -->
    <div class="mb-3">
        <label for="nombreCliente" class="form-label">Nombre del Cliente</label>
        <select name="cliente">
            @foreach ($clientes as $cliente)
                        <option value="{{$cliente->id}}">{{$cliente->nombre}}</option>
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
                    @foreach($productos as $producto)
                        <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <input type="number" class="form-control" name="cantidad[]" placeholder="Cantidad" required>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-outline-primary mb-2" onclick="agregarProducto({{ json_encode($productos) }})">Añadir Producto</button>
            </div>
        </div>
    </div>
    <input type="submit" value="Crear Pedido">

</form>

<script>
    function agregarProducto(productos) {
        const productosContainer = document.getElementById('productosContainer');

        // Nuevo conjunto de productos y cantidades
        const newRow = document.createElement('div');
        newRow.className = 'row mb-2 producto-row';

        newRow.innerHTML = `
            <div class="col-md-6">
                <select class="form-select" name="producto[]" required>
                    <!-- Genera opciones dinámicamente desde la lista de productos -->
                    ${productos.map(producto => `<option value="${producto.id}">${producto.nombre}</option>`).join('')}
                </select>
            </div>
            <div class="col-md-4">
                <input type="number" class="form-control" name="cantidad[]" placeholder="Cantidad" required>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-outline-primary mb-2" onclick="eliminarProducto(this)">Eliminar</button>
            </div>
        `;

        productosContainer.appendChild(newRow);
    }

    function eliminarProducto(btn) {
        const row = btn.closest('.producto-row');
        row.remove();
    }
</script>
@endsection

@section('footer', '©️ Cervezas Killer')
