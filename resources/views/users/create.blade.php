@extends('layouts.panelAdministracion')

@section('title', 'Crear usuario')

@section('content')
    <div class="container my-5">
        <div class="row">
            <div class="col-12">
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
                <h2 class="display-4 text-center mb-5"><strong>Crear Usuario</strong></h2>

            </div>
                <form id="userForm" action="{{ route('usuarios.store') }}" method="POST" class="col-12 col-md-8 col-lg-6">
                    @csrf

                    <div class="form-group mb-3">
                        <label for="nombre" class="form-label">Nombre:</label>
                        <input type="text" class="form-control" id="nombre" name="name" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <div class="input-group">
                            <span class="input-group-text">@</span>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="role" class="form-label">Rol:</label>
                        <select name="roles[]" class="form-select">
                            @foreach ($roles as $rol)
                                <option value="{{ $rol->name }}">{{ $rol->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label for="password" class="form-label">Contraseña:</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="password" name="password" required>
                            <button type="button" class="btn btn-outline-secondary"
                                onclick="togglePasswordVisibility('password', 'eyeIcon')">
                                <i id="eyeIcon" class="far fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="confirmPassword" class="form-label">Confirmar Contraseña:</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
                            <button type="button" class="btn btn-outline-secondary"
                                onclick="togglePasswordVisibility('confirmPassword', 'confirmEyeIcon')">
                                <i id="confirmEyeIcon" class="far fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success mt-4">Crear Usuario</button>
                    <a href="{{ route('usuarios.index') }}" class="btn btn-secondary mt-4 ms-2">Cancelar</a>
                </form>
            </div>

    </div>

    @vite(['resources/js/user.js'])
@endsection

@section('footer', '©️ Cervezas Killer')
