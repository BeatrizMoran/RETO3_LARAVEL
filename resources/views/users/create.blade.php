@extends('layouts.panelAdministracion')

@section('title', 'Página Específica')

@section('content')
<h2>Crear Usuario</h2>
<!-- Formulario de creación de usuario -->
<form action="{{ route('usuarios.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="name">Nombre:</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>
    <div class="form-group">
        <label for="email">Correo Electrónico:</label>
        <input type="email" class="form-control" id="email" name="email" required>
    </div>
    <div class="form-group">
        <label for="password">Contraseña:</label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <div class="form-group">
        <label for="role">Rol:</label>
        <select name="cliente">
            @foreach ($roles as $rol)
                        <option value="{{$rol->id}}">{{$rol->name}}</option>
             @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Crear Usuario</button>
</form>
@endsection

@section('footer', '©️ Cervezas Killer')
