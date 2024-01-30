@extends('layouts.panelAdministracion')

@section('title', 'Página Específica')

@section('content')
    <div class="container">
        <h1>Crear Producto</h1>

        <!-- Formulario de Creación -->
        <form method="post" action="{{ route('productos.store') }}" enctype="multipart/form-data">
            @csrf


            <!-- Nombre -->
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>

            <!-- Precio -->
            <div class="mb-3">
                <label for="precio" class="form-label">Precio</label>
                <input type="number" class="form-control" id="precio" name="precio" step="0.01" required>
            </div>

            <!-- Imagen -->
            <div class="mb-3">
                <label for="imagen" class="form-label">Imagen</label>
                <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*" required>
            </div>

            <!-- Formato -->
            <div class="mb-3">
                <label for="formato" class="form-label">Formato</label>
                <select class="form-select" id="formato" name="formato" required>
                    <option value="20CL">20CL</option>
                    <option value="25CL">25CL</option>
                    <option value="33CL">33CL</option>
                    <option value="1L">1L</option>
                    <option value="Barril">Barril</option>
                </select>
            </div>

            <!-- CATEGORIAS -->
            <div class="mb-3">
                <label for="categoria" class="form-label">Categoria</label>

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

            <!-- Botón de Envío -->
            <button type="submit" class="btn btn-primary">Crear Producto</button>
            <a href="{{ route('dashboard.productos') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection

@section('footer', '©️ Cervezas Killer')
