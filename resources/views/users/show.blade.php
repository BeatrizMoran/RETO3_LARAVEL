@extends('layouts.panelAdministracion')

@section('title', 'Página Específica')

@section('content')
    <div class="row">
        <div class="col">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>


    <div class="row justify-content-center">
        <div class="col-12">

            <h1>Detalles usuario</h1>
            <!-- Comercial no puede crear productos -->
            <a href="{{ route('usuarios.edit', $usuario) }}" class="btn btn-primary mb-3">Editar</a>
            <a href="{{ route('usuarios.index') }}" class="btn btn-secondary mb-3">Volver</a>
        </div>
        <div class="col-12">
            <form id="userForm" action="{{ route('usuarios.update', $usuario) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" class="form-control" id="nombre" name="name" value="{{ $usuario->name }}"
                        {{ $edit ? 'required' : 'disabled' }}>
                </div>
                <div class="form-group my-4">
                    <label for="email">Email:</label>
                    <div class="input-group">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="email" class="form-control" id="email" aria-describedby="inputGroupPrepend"
                            name="email" value="{{ $usuario->email }}" {{ $edit ? 'required' : 'disabled' }}>
                    </div>
                </div>
                <div class="form-group mb-4">
                    <label for="role">Rol:</label>
                    <select name="roles[]">
                        @foreach ($roles as $rol)
                            <option value="{{ $rol->name }}" {{ $usuario->hasRole($rol->name) ? 'selected' : '' }}
                                {{ $edit ? 'required' : 'disabled' }}>{{ $rol->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group {{ $edit ? 'd-block' : 'd-none' }}">
                    <label for="password">Contraseña:</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="password" name="password" required
                            value="{{ $usuario->password }}" {{ $edit ? 'required' : 'disabled' }}>
                        <button type="button" class="btn btn-secondary" data-input-id="password" data-eye-icon-id="eyeIcon"
                            id="mostrarOcultar">
                            <i id="eyeIcon" class="far fa-eye"></i>
                        </button>
                    </div>
                </div>
                <div class="form-group my-4 {{ $edit ? 'd-block' : 'd-none' }}">
                    <label for="confirmPassword">Confirmar Contraseña:</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword"
                            value="{{ $usuario->password }}" {{ $edit ? 'required' : 'disabled' }}>
                        <button type="button" class="btn btn-secondary" data-input-id="confirmPassword"
                            data-eye-icon-id="confirmEyeIcon" id="mostrarOcultarPasswd">
                            <i id="confirmEyeIcon" class="far fa-eye"></i>
                        </button>
                    </div>
                    <div class="invalid-feedback" id="passwordError"></div>
                </div>
                <input type="{{ $edit ? 'submit' : 'hidden' }}" class="btn btn-primary my-2" value="Actualizar usuario">
            </form>
        </div>

    </div>

    @vite(['resources/js/user.js'])


@endsection

@section('footer', '©️ Cervezas Killer')
