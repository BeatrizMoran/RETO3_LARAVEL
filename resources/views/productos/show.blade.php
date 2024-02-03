@extends('layouts.panelAdministracion')

@section('title', 'Ver producto')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6">
                @if ($errors->has('categorias'))
                    <div class="alert alert-danger">
                        <strong>{{ $errors->first('categorias') }}</strong>
                    </div>
                @endif
                <div class="mb-4">
                    <h1 class="display-4">Detalles del Producto</h1>
                </div>
                @if (auth()->user()->hasRole('responsable') ||
                        auth()->user()->hasRole('administrativo'))
                    <a href="{{ route('productos.edit', $producto) }}" class="btn btn-primary mb-md-3">Editar</a>
                @endif
                <a href="{{ $edit ? url()->previous() : route('dashboard.productos') }}"
                    class="btn btn-secondary mb-md-3">Volver</a>

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
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" class="form-control" id="precio" name="precio" step="0.01"
                                {{ $edit ? 'required' : 'disabled' }} value="{{ $producto->precio }}">
                        </div>
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
                        <select class="form-select" id="formato" name="formato" required>
                            @foreach (\App\Enums\FormatoEnum::cases() as $formato)
                                <option value="{{ $formato->value }}">{{ $formato->value }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- CATEGORIAS -->
                    <div class="mb-3">
                        <label class="form-label">Categorías</label>
                        <div class="card p-3">
                            <div class="row">
                                @foreach ($categorias as $categoria)
                                    <div class="col-6 col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="categorias[]"
                                                value="{{ $categoria->id }}" id="{{ $categoria->nombre }}"
                                                {{ in_array($categoria->id, $producto->categorias->pluck('id')->toArray()) ? 'checked' : '' }}
                                                {{ $edit ? '' : 'disabled' }}>
                                            <label class="form-check-label"
                                                for="{{ $categoria->nombre }}"><strong>{{ $categoria->nombre }}</strong></label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Botón de Envío -->
                    <input type="{{ $edit ? 'submit' : 'hidden' }}" class="btn btn-primary" value="Actualizar producto">
                </form>
            </div>
            <div class="col-12 col-md-6 text-center">
                <div class="d-flex justify-content-center align-items-center" style="height: 100%;">
                    <img class="img-fluid " src="{{ asset('storage/images/' . $producto->imagen) }}"
                        alt="Imagen del Producto">
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer', '©️ Cervezas Killer')
