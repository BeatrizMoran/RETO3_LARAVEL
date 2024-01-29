@extends('layouts.panelAdministracion')

@section('title', 'Página Específica')

@section('content')


    <div class="row">
        <div class="col-12 d-flex justify-content-center align-items-center my-3 ">
            <div class="card my-4 shadow-lg w-75 ">
                <div class="card-header p-0 position-relative mx-3 z-index-2" style="margin-top: -1.8rem;">
                    <div
                        class="bg-dark bg-gradient rounded-3 shadow-lg border-radius-lg pt-4 pb-3 d-flex justify-content-between">
                        <h6 class="text-white text-capitalize ps-3">Tabla productos</h6>
                        @if (auth()->user()->hasRole('responsable') || auth()->user()->hasRole('administrativo'))
                            <!-- Comercial no puede crear productos -->
                            <a href="{{ route('productos.create') }}" class="btn bg-success bg-gradient mb-3 mx-3"><i
                                    class="fa-solid fa-plus"></i><span class="mx-3">Añadir Producto</span></a>
                        @endif
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Código de Referencia</th>
                                    <th class="text-center">Nombre</th>
                                    <th>Precio</th>
                                    <th>Formato</th>
                                    <th>Categorías</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($productos as $producto)
                                    <tr>
                                        <td class="p-1">{{ $producto->id }}</td>
                                        <td class="p-1">{{ $producto->codigo_referencia }}</td>
                                        <td class="p-1 tex-center">{{ $producto->nombre }}</td>
                                        <td class="p-1">{{ $producto->precio }}</td>
                                        <td class="p-1">{{ $producto->formato }}</td>
                                        <td class="p-1">
                                            <select class="form-select" multiple disabled size="2">
                                                @foreach ($producto->categorias as $categoria)
                                                    <option>{{ $categoria->nombre }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td class="p-1">
                                            <a href="{{ route('productos.show', $producto) }}"
                                                class="btn btn-primary btn-md"><i class="fa-solid fa-eye"></i></a>
                                         @if (auth()->user()->hasRole('responsable') || auth()->user()->hasRole('administrativo'))

                                            <button type="button" class="btn btn-danger btn-md" data-bs-toggle="modal"
                                                data-bs-target="#confirmDeleteModal_{{ $producto->id }}"
                                                data-product-id="{{ $producto->id }}">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>

                                            <!-- VENTANA MODAL -->
                                            <div class="modal fade" id="confirmDeleteModal_{{ $producto->id }}"
                                                tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="confirmDeleteModalLabel">
                                                                Confirmar Borrado {{ $producto->id }}</h5>
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
                                                                action="{{ route('productos.destroy', $producto) }}">
                                                                @csrf
                                                                @method('DELETE')
                                                                <input type="submit" class="btn btn-danger"
                                                                    value="Eliminar">
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif

                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">No hay Productos</td>
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
