@extends('layouts.panelAdministracion')

@section('title', 'Página Específica')

@section('content')

    <div class="row ">
        <div class="col-12 d-flex justify-content-center align-items-center my-3">
            <div class="card my-4 shadow-lg w-90 px-5">
                <div class="card-header p-0 position-relative mx-3 z-index-2" style="margin-top: -1.5rem;">
                    <div
                        class="bg-gradient-primary bg-dark rounded-3 shadow-lg border-radius-lg pt-4 pb-3 d-flex justify-content-between">
                        <h6 class="text-white text-capitalize ps-3">Tabla usuarios</h6>
                        @role('responsable|administrativo')
                            <a href="{{ route('usuarios.create') }}" class="btn btn-success btn-md bg-gradient mb-3 mx-3">
                                <i class="fa-solid fa-plus"></i><span class="mx-3">Añadir usuarios</span>
                            </a>
                        @endrole

                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-items-center mb-0 text-center">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Email</th>
                                    <th>Rol</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @forelse($user->roles as $role)
                                                {{ $role->name }}<br>
                                            @empty
                                                No tiene roles asignados
                                            @endforelse
                                        </td>
                                        <td class="p-1">
                                            <a href="{{ route('usuarios.show', $user) }}" class="btn btn-primary btn-sm">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#confirmDeleteModal_{{ $user->id }}">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="confirmDeleteModal_{{ $user->id }}"
                                                tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar
                                                                Borrado {{ $user->id }}</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Cerrar"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>¿Estás seguro de que deseas borrar este usuario?</p>
                                                            <p>- Se borrarán también los pedidos asociados</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Cancelar</button>
                                                            <form method="post"
                                                                action="{{ route('usuarios.destroy', $user) }}">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="btn btn-danger">Eliminar</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">No hay usuarios registrados</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <nav class="row" aria-label="Page navigation example">
        <div class="col">
            <ul class="pagination d-flex justify-content-center">
                @if ($users->previousPageUrl())
                    <li class="page-item">
                        <a class="page-link" href="{{ $users->previousPageUrl() }}" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                @endif

                <li class="page-item disabled">
                    <span class="page-link">Página {{ $users->currentPage() }} de {{ $users->lastPage() }}</span>
                </li>

                @if ($users->nextPageUrl())
                    <li class="page-item">
                        <a class="page-link" href="{{ $users->nextPageUrl() }}" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </nav>



@endsection

@section('footer', '©️ Cervezas Killer')
