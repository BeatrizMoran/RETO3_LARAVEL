@extends('layouts.panelAdministracion')

@section('title', 'Página Específica')

@section('content')
<div class="container">
    <h1 class="my-4">Catálogo de Productos</h1>
    <a href="##" class="btn btn-primary mb-3">Añadir Producto</a>

    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Código de Referencia</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Formato</th>
                <th>Categorías</th>
                <th>Acciones</th>
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
                    <ul class="list-unstyled">
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
                <td colspan="7" class="text-center">No hay Productos</td>
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

@section('footer', '©️ Cervezas Killer')
