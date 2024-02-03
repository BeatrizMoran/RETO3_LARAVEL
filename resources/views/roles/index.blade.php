@extends('layouts.panelAdministracion')

@section('title', 'Roles')

@section('content')
    <div class="row vh-100 justify-content-center align-items-center">
        <div class="col-12 d-flex justify-content-center align-items-center my-3">
            <div class="card my-4 shadow-lg w-90 px-5">
                <div class="card-header p-0 position-relative mx-3 z-index-2" style="margin-top: -1.5rem;">
                    <div
                        class="bg-gradient-primary bg-dark rounded-3 shadow-lg border-radius-lg pt-4 pb-3 d-flex justify-content-between">
                        <h6 class="text-white text-capitalize ps-3">Tabla roles</h6>
                        @role('responsable|administrativo')
                            <a href="{{ route('roles.create') }}" class="btn btn-success btn-md bg-gradient mb-3 mx-3">
                                <i class="fa-solid fa-plus"></i><span class="mx-3">Añadir rol</span>
                            </a>
                        @endrole

                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table table-striped table-hover align-items-center mb-0 text-center">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $rol)
                                    <tr>
                                        <td>{{ $rol->id }}</td>
                                        <td>{{ $rol->name }}</td>
                                        <td class="p-1">
                                            <a href="{{ route('roles.show', $rol) }}" class="btn btn-primary btn-sm">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                            @role('responsable')
                                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#confirmDeleteModal_{{ $rol->id }}">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="confirmDeleteModal_{{ $rol->id }}"
                                                    tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar
                                                                    Borrado del Rol #{{ $rol->name }}</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                    aria-label="Cerrar"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                ¿Estás seguro de que deseas borrar el rol "{{ $rol->name }}"?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary btn-sm"
                                                                    data-bs-dismiss="modal">Cancelar</button>
                                                                <form method="post" action="{{ route('roles.destroy', $rol) }}"
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
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="d-flex justify-content-center">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            @if ($roles->previousPageUrl())
                                <li class="page-item">
                                    <a class="page-link"
                                        href="{{ $roles->appends(request()->except('page'))->previousPageUrl() }}" <span
                                        aria-hidden="true" class="text-dark">&laquo;</span>
                                    </a>
                                </li>
                            @endif

                            @if ($roles->currentPage() > 3)
                                <li class="page-item"><span class="page-link">1</span></li>
                                <li class="page-item disabled"><span class="page-link">...</span></li>
                            @endif

                            @for ($i = max(1, $roles->currentPage() - 2); $i <= min($roles->lastPage(), $roles->currentPage() + 2); $i++)
                                <li class="page-item @if ($i == $roles->currentPage()) active @endif">
                                    <a class="page-link"
                                        href="{{ $roles->appends(request()->except('page'))->url($i) }}">{{ $i }}</a>
                                </li>
                            @endfor

                            @if ($roles->currentPage() < $roles->lastPage() - 2)
                                <li class="page-item disabled"><span class="page-link">...</span></li>
                                <li class="page-item"><span class="page-link">{{ $roles->lastPage() }}</span></li>
                            @endif

                            @if ($roles->nextPageUrl())
                                <li class="page-item">
                                    <a class="page-link"
                                        href="{{ $roles->appends(request()->except('page'))->nextPageUrl() }}"
                                        aria-label="Next">
                                        <span aria-hidden="true" class="text-dark">&raquo;</span>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection
