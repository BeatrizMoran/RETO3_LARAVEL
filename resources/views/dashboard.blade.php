@extends('layouts.panelAdministracion')

@section('title', 'Página Específica')


@section('content')
    <div class="container dashboard">
        <h1>Dashboard</h1>

        @if(auth()->check())
            <p>¡Bienvenido {{ auth()->user()->name }}!</p>

            <div class="row">
                <div class="card shadow col-3 mx-3 text-center bg-info bg-gradient ">
                    <div class="card-body d-flex flex-column align-items-center justify-content-center">
                        <h5 class="card-title">Productos</h5>
                        <a href="#">
                        <i class="fa-solid fa-list-check fa-3x mb-3 text-dark"></i>
                        </a>

                        <a href="{{ route('dashboard.productos') }}">ENTRAR</a>
                    </div>
                </div>

                <div class="card shadow col-3 mx-3 text-center bg-warning bg-gradient">
                    <div class="card-body d-flex flex-column align-items-center justify-content-center">
                        <h5 class="card-title">Pedidos</h5>
                        <a href="#">
                            <i class="fa-solid fa-clipboard fa-3x mb-3 text-dark"></i>
                        </a>
                        <a href="#">ENTRAR</a>
                    </div>
                </div>

                @if(auth()->user()->hasRole('comercial'))
                    <p>¡Bienvenido Comercial! Aquí encontrarás funciones para comerciales.</p>
                    <!-- Agrega aquí los elementos específicos para el rol de Comercial -->
                @endif

                @if(auth()->user()->hasRole('administrativo') || auth()->user()->hasRole('responsable'))
                <div class="card shadow col-3 mx-3 text-center bg-success bg-gradient">

                    <div class="card-body d-flex flex-column align-items-center justify-content-center">
                        <h5 class="card-title">Clientes</h5>
                        <a href="#">
                        <i class="fa-solid fa-people-group fa-3x mb-3 text-dark"></i>
                        </a>

                        <a href="{{ route('dashboard.productos') }}">ENTRAR</a>
                    </div>
                </div>
                    <!-- Agrega aquí los elementos específicos para el rol de Administrativo -->
                @endif

                @if(auth()->user()->hasRole('responsable'))
                    <!-- Agrega aquí los elementos específicos para el rol de Responsable -->
                 
                @endif

            </div>

        @endif
    </div>
@endsection

@section('footer', '©️ Cervezas killer')
