@extends('layouts.panelAdministracion')

@section('title', 'Crear Permiso')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6">
                <div class="card shadow-lg">
                    <div class="card-header bg-gradient-primary bg-dark text-white">
                        <h5 class="card-title my-3">Crear nueva categoria</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('categorias.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre de la categoria:</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                            </div>
                            <div class="d-flex justify-content-between">
                                <button type="submit" class="btn btn-success">Guardar</button>
                                <a href="{{ route('categorias.index') }}" class="btn btn-secondary">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
