@extends('layouts.panelAdministracion')

@section('title', 'Editar categoria')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6">
                <div class="card shadow-lg">
                    <div class="card-header bg-gradient-primary bg-dark text-white">
                        <h5 class="card-title my-3">Editar Permiso: {{ $categoria->nombre }}</h5>
                    </div>
                    <div class="card-body">
                        <!-- Mostrar errores de validación -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('categorias.update', $categoria) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre del permiso</label>
                                <input type="text" class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}"
                                    id="nombre" name="nombre" value="{{ old('nombre', $categoria->nombre) }}" required>
                                @if ($errors->has('nombre'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('nombre') }}
                                    </div>
                                @endif
                            </div>
                            <div class="d-flex justify-content-between">
                                <button type="submit" class="btn btn-success">Actualizar</button>
                                <a href="{{ route('categorias.index') }}" class="btn btn-secondary">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
