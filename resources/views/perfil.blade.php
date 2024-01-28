@extends('layouts.panelAdministracion')

@section('title', 'Página Específica')

@section('content')

    <div class="container d-flex justify-content-center my-4 ">
        <!-- Primer div -->
        <div class="rounded-4 w-100 p-3 bg-primary position-relative"
            style="height: 230px; background: url('{{ url('fondo-perfil.jpg') }}'); background-size: cover;">
        </div>
        <!-- Segundo div -->
        <div class="position-absolute rounded-4 p-3 bg-light bg-degraded card card-body mx-3 mx-md-4 mt-n6"
            style="70%;z-index: 2;top:180px;width:60%;">
            <div class="card">
                <div class="card-header dark:bg-dark">
                    Informacion Perfil
                </div>
                <img src="{{ url('Killerlogo.png') }}" alt="foto-perfil" class="rounded-circle m-2" width="100"
                    height="100">
                <div class="card-body">
                    <form action="##" method="POST">
                        @csrf

                        <!-- Nombre -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>

                        <!-- Correo Electrónico -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>

                        <!-- Contraseña -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>

                        <!-- Imagen -->
                        <div class="mb-3">
                            <label for="imagen" class="form-label">Imagen (URL)</label>
                            <input type="text" class="form-control" id="imagen" name="imagen" value="./avatar.png">
                        </div>

                        <!-- Botón de Enviar -->
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </form>
                </div>
            </div>
            <label class="switch" for="dark-mode-toggle">
                <input type="checkbox" id="dark-mode-toggle">
                <span class="slider">
                    <i class="fas fa-moon"></i>
                    <i class="fas fa-sun"></i>
                </span>
            </label>
            

        </div>

    </div>






@endsection

@section('footer', '©️ Cervezas Killer')
