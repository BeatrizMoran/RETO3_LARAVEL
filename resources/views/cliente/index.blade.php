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
                <th>Codigo cliente</th>
                <th>Nombre</th>
                <th>Direccion</th>
                <th>telefono</th>
            </tr>
        </thead>
        <tbody>
            @forelse($clientes as $cliente)
            <tr>
                <td>{{ $cliente->id }}</td>
                <td>{{ $cliente->nombre }}</td>
                <td>{{ $cliente->direccion }}</td>
                <td>{{ $cliente->telefono }}</td>

                <td>
                    <a href="##" class="btn btn-primary btn-sm">Entrar</a>
                    <a href="#" class="btn btn-danger btn-sm">Borrar</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">No hay bodegas</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <!--paginacion -->
    <div class="d-flex justify-content-center mt-4"> <!-- Alineación central y margen superior -->
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                @if ($clientes->previousPageUrl())
                    <li class="page-item">
                        <a class="page-link" href="{{ $clientes->previousPageUrl() }}" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                @endif

                <li class="page-item disabled">
                    <span class="page-link">Página {{ $clientes->currentPage() }} de {{ $clientes->lastPage() }}</span>
                </li>

                @if ($clientes->nextPageUrl())
                    <li class="page-item">
                        <a class="page-link" href="{{ $clientes->nextPageUrl() }}" aria-label="Next">
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
