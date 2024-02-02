@extends('layouts.panelAdministracion')

@section('title', 'Detalles')

@section('content')

<div class="row">
    <div class="col-7">
        @if ($errors->has('categorias'))
            <div class="alert alert-danger">
                <strong>{{ $errors->first('categorias') }}</strong>
            </div>
        @endif
        <div>
            <h1>Detalles producto</h1>

        </div>
        <div>
            @if (auth()->user()->hasRole('responsable') ||
            auth()->user()->hasRole('administrativo'))
        <!-- Comercial no puede crear productos -->
        <a href="{{ route('productos.edit', $producto) }}" class="btn btn-warning mb-3">Editar</a>
    @endif

    <a href="{{ route('dashboard.productos') }}" class="btn btn-secondary mb-3">Volver</a>
        </div>



        <!-- Formulario de Creación -->
        <form method="post" action="{{ route('productos.update', $producto) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <!-- Nombre -->
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre"
                    {{ $edit ? 'required' : 'disabled' }} value="{{ $producto->nombre }}">
            </div>

            <!-- Precio -->
            <div class="mb-3">
                <label for="precio" class="form-label">Precio</label>
                <input type="number" class="form-control" id="precio" name="precio" step="0.01"
                    {{ $edit ? 'required' : 'disabled' }} value="{{ $producto->precio }}">
            </div>

            <!-- Imagen -->
            <div class="mb-3">
                <label for="imagen" class="form-label">Imagen</label>
                <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*"
                    {{ $edit ? 'enabled' : 'disabled' }}>
            </div>

            <!-- Formato -->
            <div class="mb-3">
                <label for="formato" class="form-label">Formato</label>
                <select class="form-select" id="formato" name="formato" {{ $edit ? 'required' : 'disabled' }}>
                    <option value="20CL" {{ $producto->formato == '20CL' ? 'selected' : '' }}>20CL</option>
                    <option value="25CL" {{ $producto->formato == '25CL' ? 'selected' : '' }}>25CL</option>
                    <option value="33CL" {{ $producto->formato == '33CL' ? 'selected' : '' }}>33CL</option>
                    <option value="1L" {{ $producto->formato == '1L' ? 'selected' : '' }}>1L</option>
                    <option value="Barril" {{ $producto->formato == 'Barril' ? 'selected' : '' }}>Barril</option>
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
                                    value="{{ $categoria->id }}" id="{{ $categoria->nombre }}"
                                    {{ in_array($categoria->id, $producto->categorias->pluck('id')->toArray()) ? 'checked' : '' }}
                                    {{ $edit ? '' : 'disabled' }}>
                                <label class="form-check-label"
                                    for="{{ $categoria->nombre }}">{{ $categoria->nombre }}</label>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>


            <!-- Botón de Envío -->
            <input type="{{ $edit ? 'submit' : 'hidden' }}" class="btn btn-primary" value="Actualizar producto">
        </form>
    </div>
    <div class="col-3">
        <img class="img-thumbnail" src="{{ asset('storage/images/' . $producto->imagen) }}" />
    </div>
</div>

@endsection

@section('footer', '©️ Cervezas Killer')
