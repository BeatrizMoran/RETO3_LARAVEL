@extends('layouts.panelAdministracion')

@section('title', 'Página Específica')

@section('content')

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if(session('danger'))
        <div class="alert alert-danger">
            {{ session('danger') }}
        </div>
    @endif

<div class="container">
    <h1 class="my-4">Productos</h1>
    @if(auth()->user()->hasRole('responsable') || auth()->user()->hasRole('administrativo'))
        <!-- Comercial no puede crear productos -->
        <a href="{{ route('productos.create') }}" class="btn btn-primary mb-3">Añadir Producto</a>
     @endif

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
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal_{{ $producto->id }}" data-product-id="{{ $producto->id }}">
                    Borrar
                </button>

                        <!-- VENTANA MODAL -->
                        <div class="modal fade" id="confirmDeleteModal_{{ $producto->id }}" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar Borrado {{ $producto->id}}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                        </div>
                                        <div class="modal-body">
                                            ¿Estás seguro de que deseas borrar este producto?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                <form  method="post" action="{{ route('productos.destroy', $producto) }}">
                                                @csrf
                                                @method('DELETE')
                                                <input type="submit" class="btn btn-danger" value="Eliminar">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">No hay Productos</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="d-flex justify-content-center mt-4">
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
