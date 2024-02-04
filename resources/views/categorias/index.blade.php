@extends('layouts.panelAdministracion')

@section('title', 'Categorias')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10">
                <div class="card my-4 shadow-lg">
                    <div class="card-header p-0 position-relative mx-3 z-index-2" style="margin-top: -1.5rem;">
                        <div
                            class="bg-gradient-primary bg-dark rounded-3 shadow-lg border-radius-lg pt-4 pb-3 d-flex justify-content-between">
                            <h6 class="text-white text-capitalize ps-3">Tabla categorias</h6>
                            @role('responsable|administrativo')
                                <a href="{{ route('categorias.create') }}" class="btn btn-success btn-md bg-gradient mb-3 mx-3">
                                    <i class="fa-solid fa-plus"></i><span class="mx-3">Añadir categoria</span>
                                </a>
                            @endrole
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table table-striped table-hover align-items-center mb-0 p-4 text-center">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categorias as $categoria)
                                        <tr>
                                            <td>{{ $categoria->nombre }}</td>
                                            <td>
                                                <a href="{{ route('categorias.edit', $categoria) }}"
                                                class="btn btn-warning"> <i class="fa-solid fa-edit"></i></a>
                                                <button type="button" class="btn btn-danger " data-bs-toggle="modal"
                                                    data-bs-target="#confirmDeleteModal_{{ $categoria->id }}">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>

                                                <!-- VENTANA MODAL -->
                                                <div class="modal fade" id="confirmDeleteModal_{{ $categoria->id }}"
                                                    tabindex="-1" aria-labelledby="confirmDeleteModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="confirmDeleteModalLabel">
                                                                    Confirmar borrado del permiso #{{ $categoria->id }}
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                ¿Estás seguro de que deseas borrar la categoria?
                                                                "{{ $categoria->nombre }}"?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary btn-sm"
                                                                    data-bs-dismiss="modal">Cancelar</button>
                                                                <form method="post"
                                                                    action="{{ route('categorias.destroy', $categoria) }}"
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
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                @if ($categorias->previousPageUrl())
                    <li class="page-item">
                        <a class="page-link"
                            href="{{ $categorias->appends(request()->except('page'))->previousPageUrl() }}">
                            <span aria-hidden="true" class="text-dark">&laquo;</span>
                        </a>
                    </li>
                @endif
                @if ($categorias->currentPage() > 3)
                    <li class="page-item"><span class="page-link">1</span></li>
                    <li class="page-item disabled"><span class="page-link">...</span></li>
                @endif
                @for ($i = max(1, $categorias->currentPage() - 2); $i <= min($categorias->lastPage(), $categorias->currentPage() + 2); $i++)
                    <li class="page-item @if ($i == $categorias->currentPage()) active @endif">
                        <a class="page-link"
                            href="{{ $categorias->appends(request()->except('page'))->url($i) }}">{{ $i }}</a>
                    </li>
                @endfor
                @if ($categorias->currentPage() < $categorias->lastPage() - 2)
                    <li class="page-item disabled"><span class="page-link">...</span></li>
                    <li class="page-item"><span class="page-link">{{ $categorias->lastPage() }}</span></li>
                @endif
                @if ($categorias->nextPageUrl())
                    <li class="page-item">
                        <a class="page-link" href="{{ $categorias->appends(request()->except('page'))->nextPageUrl() }}"
                            aria-label="Next">
                            <span aria-hidden="true" class="text-dark">&raquo;</span>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
@endsection
