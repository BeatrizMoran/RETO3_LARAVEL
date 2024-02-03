@extends('layouts.panelAdministracion')

@section('title', 'Página Específica')

@section('content')
    <div class="row">
        <div class="col-12 d-flex justify-content-center align-items-center my-3">
            <div class="card my-4 shadow-lg w-90 px-5">
                <div class="card-header p-0 position-relative mx-3 z-index-2" style="margin-top: -1.5rem;">
                    <div
                        class="bg-gradient-primary bg-dark rounded-3 shadow-lg border-radius-lg pt-4 pb-3 d-flex justify-content-between">
                        <h6 class="text-white text-capitalize ps-3">Tabla productos</h6>
                        @role('responsable|administrativo')
                            <a href="{{ route('productos.create') }}" class="btn btn-success btn-md bg-gradient mb-3 mx-3">
                                <i class="fa-solid fa-plus"></i><span class="mx-3">Añadir producto</span>
                            </a>
                        @endrole

                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover mb-0 text-center">
                            <thead>
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
                                        
                                        @if (count($producto->categorias) > 0)
                                            <td>
                                                <select class="form-select" multiple disabled size="2">
                                                    @foreach ($producto->categorias as $categoria)
                                                        <option>{{ $categoria->nombre }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        @else
                                            <td>No tiene categoria</td>

                                        @endif
                                        <td>
                                        <a href="{{ route('productos.show', $producto) }}" class="btn btn-primary btn-sm">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        @role('responsable|administrativo')
                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#confirmDeleteModal_{{ $producto->id }}">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>

                                            <!-- VENTANA MODAL -->
                                            <div class="modal fade" id="confirmDeleteModal_{{ $producto->id }}" tabindex="-1"
                                                aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="confirmDeleteModalLabel">
                                                                Confirmar Borrado del Producto
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Cerrar"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            ¿Estás seguro de que deseas borrar el producto
                                                            "{{ $producto->nombre }}"?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary btn-sm"
                                                                data-bs-dismiss="modal">Cancelar</button>
                                                            <form method="post"
                                                                action="{{ route('productos.destroy', $producto) }}"
                                                                class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <input type="submit" class="btn btn-danger btn-sm"
                                                                    value="Eliminar">
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endrole
                                        <td/>
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
    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    @if ($productos->previousPageUrl())
                        <li class="page-item">
                            <a class="page-link"
                                href="{{ $productos->appends(request()->except('page'))->previousPageUrl() }}" <span
                                aria-hidden="true" class="text-dark">&laquo;</span>
                            </a>
                        </li>
                    @endif

                    @if ($productos->currentPage() > 3)
                        <li class="page-item"><span class="page-link">1</span></li>
                        <li class="page-item disabled"><span class="page-link">...</span></li>
                    @endif

                    @for ($i = max(1, $productos->currentPage() - 2); $i <= min($productos->lastPage(), $productos->currentPage() + 2); $i++)
                        <li class="page-item @if ($i == $productos->currentPage()) active @endif">
                            <a class="page-link"
                                href="{{ $productos->appends(request()->except('page'))->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor

                    @if ($productos->currentPage() < $productos->lastPage() - 2)
                        <li class="page-item disabled"><span class="page-link">...</span></li>
                        <li class="page-item"><span class="page-link">{{ $productos->lastPage() }}</span></li>
                    @endif

                    @if ($productos->nextPageUrl())
                        <li class="page-item">
                            <a class="page-link" href="{{ $productos->appends(request()->except('page'))->nextPageUrl() }}"
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
