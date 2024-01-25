@extends('layouts.panelAdministracion')

@section('title', 'Página Específica')


@section('content')
    <div class="container">
        <h1>Dashboard</h1>

        @if(auth()->check())
            <p>¡Bienvenido {{ auth()->user()->name }}!</p>

            <div class="row">
                <div class="card shadow col-3 mx-3">
                    <i class="bi bi-clipboard-check"></i>
                    <div class="card-body">
                        <h5 class="card-title">Productos</h5>
                        <a href="{{ route("productos.index") }}">ENTRAR</a>
                    </div>
                </div>

                <div class="card shadow col-3 mx-3">
                    <i class="bi bi-clipboard-check"></i>
                    <div class="card-body">
                        <h5 class="card-title">Pedidos</h5>
                        <a href="#">ENTRAR</a>
                    </div>
                </div>
                @if(auth()->user()->hasRole('comercial'))
                    <p>¡Bienvenido Comercial! Aquí encontrarás funciones para comerciales.</p>
                    <!-- Agrega aquí los elementos específicos para el rol de Comercial -->
                @endif

                @if(auth()->user()->hasRole('administrativo'))
                    <p>¡Hola Administrativo! Aquí encontrarás funciones para administrativos.</p>
                    <div class="card shadow col-auto">
                        <i class="bi bi-clipboard-check"></i>
                        <div class="card-body">
                            <h5 class="card-title">Clientes</h5>
                            <a href="#">ENTRAR</a>
                        </div>
                    </div>
                    <!-- Agrega aquí los elementos específicos para el rol de Administrativo -->
                @endif

                @if(auth()->user()->hasRole('responsable'))
                    <!-- Agrega aquí los elementos específicos para el rol de Responsable -->
                    <div class="card shadow col-3 mx-3">
                        <i class="bi bi-clipboard-check"></i>
                        <div class="card-body">
                            <h5 class="card-title">Clientes</h5>
                            <a href="#">ENTRAR</a>
                        </div>
                    </div>
                @endif

            </div>

        @endif
    </div>
@endsection

@section('footer', '©️ Cervezas killer')
