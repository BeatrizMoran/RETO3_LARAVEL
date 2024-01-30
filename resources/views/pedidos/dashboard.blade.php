@extends('layouts.panelAdministracion')

@section('title', 'Página Específica')

@section('content')


    <div class="row">
        <div class="col-12 d-flex justify-content-center align-items-center my-3 ">
            <div class="card my-4 shadow-lg w-75 ">
                <div class="card-header p-0 position-relative mx-3 z-index-2" style="margin-top: -1.8rem;">
                    <div
                        class="bg-dark bg-gradient rounded-3 shadow-lg border-radius-lg pt-4 pb-3 d-flex justify-content-between">
                        <h6 class="text-white text-capitalize ps-3">Tabla pedidos</h6>
                        @if (auth()->user()->hasRole('responsable') ||
                                auth()->user()->hasRole('comercial'))
                            <!-- Comercial no puede crear productos -->
                            <a href="{{ route('pedidos.create') }}" class="btn bg-success bg-gradient mb-3 mx-3"><i
                                    class="fa-solid fa-plus"></i><span class="mx-3">Añadir Pedido</span></a>
                        @endif
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="p-0">
                        <table class="table align-items-center mb-0">
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
                                        <td class="p-1 tex-center">{{ $pedido->cliente->nombre }}</td>
                                        <td>
                                            @foreach ($pedido->users as $usuario)
                                                {{ $usuario->name }}
                                            @endforeach
                                        </td>
                                        <td class="p-1">{{ $pedido->created_at }}</td>
                                       
                                        <td class="p-1">{{ $pedido->estado }}</td>

                                        <td class="p-1">
                                            <a href="{{ route('pedidos.show', $pedido) }}" class="btn btn-primary btn-md"><i
                                                    class="fa-solid fa-eye"></i></a>
                                            <button type="button" class="btn btn-danger btn-md" data-bs-toggle="modal"
                                                data-bs-target="#confirmDeleteModal_{{ $pedido->id }}"
                                                data-product-id="{{ $pedido->id }}">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>

                                            <!-- VENTANA MODAL -->
                                            <div class="modal fade" id="confirmDeleteModal_{{ $pedido->id }}"
                                                tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="confirmDeleteModalLabel">
                                                                Confirmar Borrado {{ $pedido->id }}</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Cerrar"></button>
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


    <div class="d-flex justify-content-center ">
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                @if ($pedidos->previousPageUrl())
                    <li class="page-item">
                        <a class="page-link" href="{{ $pedidos->previousPageUrl() }}" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                @endif

                <li class="page-item disabled">
                    <span class="page-link">Página {{ $pedidos->currentPage() }} de {{ $pedidos->lastPage() }}</span>
                </li>

                @if ($pedidos->nextPageUrl())
                    <li class="page-item">
                        <a class="page-link" href="{{ $pedidos->nextPageUrl() }}" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
    </div>




@endsection

@section('footer', '©️ Cervezas Killer')
