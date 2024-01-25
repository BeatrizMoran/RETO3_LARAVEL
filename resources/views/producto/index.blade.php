@extends('layouts.panelAdministracion')

@section('title', 'Página Específica')

@section('content')
<div class="container">
    <h1 class="my-4">catalogo de productos</h1>
    <a href="##" class="btn btn-primary mb-3">Añadir Producto</a>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Codigo referencia</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Formato</th>
                <th>Categoria/s</th>
            </tr>
        </thead>
        <tbody>
            @forelse($productos as $producto)
            <tr>
                <td>{{ $producto->id }}</td>
                <td>{{ $producto->codigo_referencia }}</td>
                <td>{{ $producto->nombre }}</td>
                <td>{{ $producto->precio }}</td>
                <td>{{ $producto->formato }}</td>
                <td>
                    <ul>
                @foreach($producto->categorias as $categoria)
                        <li>{{ $categoria->nombre }}</li>
                @endforeach
                    </ul>
                </td>
                <td>
                    <a href="##" class="btn btn-primary btn-sm">Entrar</a>
                    <a href="#" class="btn btn-danger btn-sm">Borrar</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">No hay Productos</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="d-flex justify-content-center mt-4"> <!-- Alineación central y margen superior -->
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                @if ($productos->previousPageUrl())
                    <li class="page-item">
                        <a class="page-link" href="{{ $productos->previousPageUrl() }}" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                @endif

                <li class="page-item disabled">
                    <span class="page-link">Página {{ $productos->currentPage() }} de {{ $productos->lastPage() }}</span>
                </li>

                @if ($productos->nextPageUrl())
                    <li class="page-item">
                        <a class="page-link" href="{{ $productos->nextPageUrl() }}" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
    </div>



</div>

@endsection

@section('footer', '©️ Cervezas killer')
