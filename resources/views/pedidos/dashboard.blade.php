@extends('layouts.panelAdministracion')

@section('title', 'Página Específica')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10">
                <div class="card my-4 shadow-lg">
                    <div class="card-header p-0 position-relative mx-3 z-index-2" style="margin-top: -1.5rem;">
                        <div
                            class="bg-gradient-primary bg-dark rounded-3 shadow-lg border-radius-lg pt-4 pb-3 d-flex justify-content-between">
                            <h6 class="text-white text-capitalize ps-3">Tabla pedidos</h6>
                            @role('responsable|administrativo')
                                <a href="{{ route('pedidos.create') }}" class="btn btn-success btn-md bg-gradient mb-3 mx-3">
                                    <i class="fa-solid fa-plus"></i><span class="mx-3">Añadir pedido</span>
                                </a>
                            @endrole
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table table-striped table-hover align-items-center mb-0 p-4 text-center">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Cliente</th>
                                        <th>Usuario</th>
                                        <th>Fecha</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($pedidos as $pedido)
                                        <tr>
                                            <td class="p-1">{{ $pedido->id }}</td>
                                            <td class="p-1 text-center">{{ $pedido->cliente->nombre }}</td>
                                            <td>
                                                @foreach ($pedido->users as $usuario)
                                                    {{ $usuario->name }}
                                                @endforeach
                                            </td>
                                            <td class="p-1">{{ $pedido->created_at }}</td>
                                            <td class="p-1">{{ $pedido->estado }}</td>
                                            <td class="p-1">
                                                <a href="{{ route('pedidos.show', $pedido) }}"
                                                    class="btn btn-primary btn-md">
                                                    <i class="fa-solid fa-eye"></i>
                                                </a>
                                                <button type="button" class="btn btn-danger btn-md" data-bs-toggle="modal"
                                                    data-bs-target="#confirmDeleteModal_{{ $pedido->id }}"
                                                    data-product-id="{{ $pedido->id }}">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                                <!-- VENTANA MODAL -->
                                                <div class="modal fade" id="confirmDeleteModal_{{ $pedido->id }}"
                                                    tabindex="-1" aria-labelledby="confirmDeleteModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="confirmDeleteModalLabel">
                                                                    Confirmar Borrado {{ $pedido->id }}</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                ¿Estás seguro de que deseas borrar este producto?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Cancelar</button>
                                                                <form method="post"
                                                                    action="{{ route('pedidos.destroy', $pedido) }}">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <input type="submit" class="btn btn-danger"
                                                                        value="Eliminar">
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">No hay pedidos</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    @if ($pedidos->previousPageUrl())
                        <li class="page-item">
                            <a class="page-link"
                                href="{{ $pedidos->appends(request()->except('page'))->previousPageUrl() }}">
                                <span aria-hidden="true" class="text-dark">&laquo;</span>
                            </a>
                        </li>
                    @endif
                    @if ($pedidos->currentPage() > 3)
                        <li class="page-item"><span class="page-link">1</span></li>
                        <li class="page-item disabled"><span class="page-link">...</span></li>
                    @endif
                    @for ($i = max(1, $pedidos->currentPage() - 2); $i <= min($pedidos->lastPage(), $pedidos->currentPage() + 2); $i++)
                        <li class="page-item @if ($i == $pedidos->currentPage()) active @endif">
                            <a class="page-link"
                                href="{{ $pedidos->appends(request()->except('page'))->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor
                    @if ($pedidos->currentPage() < $pedidos->lastPage() - 2)
                        <li class="page-item disabled"><span class="page-link">...</span></li>
                        <li class="page-item"><span class="page-link">{{ $pedidos->lastPage() }}</span></li>
                    @endif
                    @if ($pedidos->nextPageUrl())
                        <li class="page-item">
                            <a class="page-link" href="{{ $pedidos->appends(request()->except('page'))->nextPageUrl() }}"
                                aria-label="Next">
                                <span aria-hidden="true" class="text-dark">&raquo;</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>
    </div>
@endsection

@section('footer', '©️ Cervezas Killer')
