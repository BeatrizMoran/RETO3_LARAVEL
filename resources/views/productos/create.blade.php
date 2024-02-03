@extends('layouts.panelAdministracion')

@section('title', 'Página Específica')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="mb-4">Crear Producto</h1>

                <!-- Formulario de Creación -->
                <form method="post" action="{{ route('productos.store') }}" enctype="multipart/form-data">
                    @csrf

                    <!-- Nombre -->
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                        @error('nombre')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Precio -->
                    <div class="mb-3">
                        <label for="precio" class="form-label">Precio</label>
                        <input type="number" class="form-control" id="precio" name="precio" step="0.01" required>
                        @error('precio')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Imagen -->
                    <div class="mb-3">
                        <label for="imagen" class="form-label">Imagen</label>
                        <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*" required>
                        @error('imagen')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Formato -->
                    <div class="mb-3">
                        <label for="formato" class="form-label">Formato</label>
                        <select class="form-select" id="formato" name="formato" required>
                            @foreach (\App\Enums\FormatoEnum::cases() as $formato)
                                <option value="{{ $formato->value }}">{{ $formato->value }}</option>
                            @endforeach
                        </select>

                    </div>

                    <!-- CATEGORIAS -->
                    <div class="mb-3">
                        <div class="card p-3">
                            <label for="categoria" class="form-label">Categoría</label>

                            <div class="row">
                                @foreach ($categorias as $categoria)
                                    <div class="col-6 col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="categorias[]"
                                                value="{{ $categoria->id }}" id="{{ $categoria->nombre }}">
                                            <label class="form-check-label"
                                                for="{{ $categoria->nombre }}">{{ $categoria->nombre }}</label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Botones de Envío y Cancelar -->
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Crear Producto</button>
                        <a href="{{ route('dashboard.productos') }}" class="btn btn-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>

    </div>
    </div>

@endsection

@section('footer', '©️ Cervezas Killer')
