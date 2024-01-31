@extends('layouts.panelAdministracion')

@section('title', 'Página Específica')

@section('content')
    <div class="container-fluid">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1 class="mt-5">Detalles del usuario</h1>
                <div class="d-flex justify-content-between my-3">
                    <a href="{{ route('usuarios.edit', $usuario) }}" class="btn btn-primary">Editar</a>
                    <a href="{{ $edit ? url()->previous() : route('usuarios.index') }}" class="btn btn-secondary">Volver</a>
                </div>

                <form id="userForm" action="{{ route('usuarios.update', $usuario) }}" method="POST" class="mt-3">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre:</label>
                        <input type="text" class="form-control" id="nombre" name="name"
                            value="{{ $usuario->name }}" {{ $edit ? 'required' : 'disabled' }}>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <div class="input-group">
                            <span class="input-group-text" id="inputGroupPrepend">@</span>
                            <input type="email" class="form-control" id="email" aria-describedby="inputGroupPrepend"
                                name="email" value="{{ $usuario->email }}" {{ $edit ? 'required' : 'disabled' }}>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="role" class="form-label">Rol:</label>
                        <select class="form-select" name="roles[]" {{ $edit ? '' : 'disabled' }}>
                            @foreach ($roles as $rol)
                                <option value="{{ $rol->name }}"
                                    {{ $usuario->hasRole($rol->name) ? 'selected' : '' }}>{{ $rol->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    @if ($edit)
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña:</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="password" name="password">
                                <button type="button" class="btn btn-outline-secondary"
                                    onclick="togglePasswordVisibility('password', 'eyeIcon')">
                                    <i id="eyeIcon" class="far fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="confirmPassword" class="form-label">Confirmar Contraseña:</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="confirmPassword" name="confirmPassword">
                                <button type="button" class="btn btn-outline-secondary"
                                    onclick="togglePasswordVisibility('confirmPassword', 'confirmEyeIcon')">
                                    <i id="confirmEyeIcon" class="far fa-eye"></i>
                                </button>
                            </div>
                            <div class="invalid-feedback" id="passwordError"></div>
                        </div>

                        <button type="submit" class="btn btn-primary">Actualizar usuario</button>
                    @endif
                </form>
            </div>
        </div>
    </div>

    @vite(['resources/js/user.js'])
@endsection

@section('footer', '©️ Cervezas Killer')
