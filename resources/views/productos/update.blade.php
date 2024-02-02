@extends('layouts.panelAdministracion')

@section('title', 'Página Específica')

@section('content')

<div class="row">
    <div class="col">
        <h1>Actualizar Producto</h1>

        <!-- Formulario de Creación -->
        <form method="post" action="{{ route('productos.store') }}" enctype="multipart/form-data">
            @csrf

            <!-- Código de Referencia -->
            <div class="mb-3">
                <label for="codigo_referencia" class="form-label">Código de Referencia</label>
                <input type="text" class="form-control" id="codigo_referencia" name="codigo_referencia" required>
            </div>

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

            <!-- Botón de Envío -->
            <button type="submit" class="btn btn-primary">Crear Producto</button>
        </form>
    </div>
</div>
@endsection

@section('footer', '©️ Cervezas Killer')
