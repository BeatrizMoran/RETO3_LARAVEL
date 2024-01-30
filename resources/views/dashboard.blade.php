@extends('layouts.panelAdministracion')

@section('title', 'Página Específica')

@section('content')
    <div class=" dashboard">
        <h1 class="fw-bold fs-1 mb-2 my-3">Dashboard</h1>

        @auth
            <p>¡Bienvenido {{ auth()->user()->name }}!</p>


            <div class="row d-flex justify-content-center">
                @role('responsable|administrativo|comercial')
                    <div class="card shadow col-sm-12 col-md-5 col-lg-3 mx-3 text-center bg-info bg-gradient my-3 mx-3">
                        <div class="card-body d-flex flex-column align-items-center justify-content-center">
                            <h5 class="card-title">Productos</h5>
                            <a href="#">
                                <i class="fa-solid fa-list-check fa-3x mb-3 text-dark"></i>
                            </a>
                            <a href="{{ route('dashboard.productos') }}" class="btn btn-dark mb-3">ENTRAR</a>
                        </div>
                    </div>
                @endrole

                @role('responsable|administrativo|comercial')
                    <div class="card shadow col-sm-12 col-md-5 col-lg-3 mx-3 text-center bg-warning bg-gradient my-3 mx-3">
                        <div class="card-body d-flex flex-column align-items-center justify-content-center">
                            <h5 class="card-title">Pedidos</h5>
                            <a href="#">
                                <i class="fa-solid fa-clipboard fa-3x mb-3 text-dark"></i>
                            </a>
                            <a href="{{ route('pedidos.index') }}" class="btn btn-dark mb-3">ENTRAR</a>
                        </div>
                    </div>
                @endrole
                @role('responsable|administrativo')
                    <div class="card shadow col-sm-12 col-md-5 col-lg-3 mx-3 text-center bg-info bg-gradient my-3 mx-3">
                        <div class="card-body d-flex flex-column align-items-center justify-content-center">
                            <h5 class="card-title">Clientes</h5>
                            <i class="fa-solid fa-people-group fa-3x mb-3 text-dark"></i>
                            <a href="{{ route('clientes.index') }}" class="btn btn-dark mb-3">ENTRAR</a>
                        </div>
                    </div>
                @endrole


                <!-- Agrega aquí los elementos específicos para el rol de Administrativo -->

                @role('responsable')
                    <div class="card shadow col-sm-12 col-md-5 col-lg-3 mx-3 text-center bg-info bg-gradient my-3 mx-3">
                        <div class="card-body d-flex flex-column align-items-center justify-content-center">
                            <h5 class="card-title">Usuarios</h5>
                            <i class="fa-solid fa-users fa-3x mb-3 text-dark"></i>
                            <a href="{{ route('usuarios.index') }}" class="btn btn-dark mb-3">ENTRAR</a>
                        </div>
                    </div>
                @endrole


            </div>
        @endauth
    </div>
@endsection

@section('footer', '©️ Cervezas killer')
