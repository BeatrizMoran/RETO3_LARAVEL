@extends('layouts.panelAdministracion')

@section('title', 'Página Específica')

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <h2>Crear Usuario</h2>
    <!-- Formulario de creación de usuario -->

    <div class="row justify-content-center">
        <form id="userForm" action="{{route('usuarios.store')}}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <div class="input-group">
                    <span class="input-group-text" id="inputGroupPrepend">@</span>
                    <input type="email" class="form-control" id="email" aria-describedby="inputGroupPrepend" name="email" required>
                </div>
            </div>
            <div class="form-group">
                <label for="role">Rol:</label>
                <select name="roles[]">
                    @foreach ($roles as $rol)
                        <option value="{{ $rol->name }}">{{ $rol->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="password" name="password" required>
                    <button type="button" class="btn btn-secondary" data-input-id="password" data-eye-icon-id="eyeIcon" id="mostrarOcultar">
                        <i id="eyeIcon" class="far fa-eye"></i>
                    </button>
                </div>
            </div>
            <div class="form-group">
                <label for="confirmPassword">Confirmar Contraseña:</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
                    <button type="button" class="btn btn-secondary" data-input-id="confirmPassword" data-eye-icon-id="confirmEyeIcon" id="mostrarOcultarPasswd">
                        <i id="confirmEyeIcon" class="far fa-eye"></i>
                    </button>
                </div>
                <div class="invalid-feedback" id="passwordError"></div>
            </div>
            <button type="button" class="btn btn-primary my-5" id="crearUsuario">Crear Usuario</button>
        </form>
    </div>

    <!-- Incluir el script externo -->
    @vite(['resources/js/user.js'])
    @endsection

@section('footer', '©️ Cervezas Killer')
