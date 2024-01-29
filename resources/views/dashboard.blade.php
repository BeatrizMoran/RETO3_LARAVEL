@extends('layouts.panelAdministracion')

@section('title', 'Página Específica')

@section('content')
    <div class=" dashboard">
        <h1 class="fw-bold fs-1 mb-2 my-3">Dashboard</h1>

        @if (auth()->check())
            <p>¡Bienvenido {{ auth()->user()->name }}!</p>

            <div class="row d-flex justify-content-center">
                <div class="card shadow col-sm-12 col-md-5 col-lg-3 mx-3 text-center bg-info bg-gradient my-3 mx-3">
                    <div class="card-body d-flex flex-column align-items-center justify-content-center">
                        <h5 class="card-title">Productos</h5>
                        <a href="#">
                            <i class="fa-solid fa-list-check fa-3x mb-3 text-dark"></i>
                        </a>
                        <a href="{{ route('dashboard.productos') }}" class="btn btn-dark mb-3">ENTRAR</a>
                    </div>
                </div>

                <div class="card shadow col-sm-12 col-md-5 col-lg-3 mx-3 text-center bg-warning bg-gradient my-3 mx-3">
                    <div class="card-body d-flex flex-column align-items-center justify-content-center">
                        <h5 class="card-title">Pedidos</h5>
                        <a href="#">
                            <i class="fa-solid fa-clipboard fa-3x mb-3 text-dark"></i>
                        </a>
                        <a href="{{ route('pedidos.index') }}" class="btn btn-dark mb-3">ENTRAR</a>
                    </div>
                </div>

                @if (auth()->user()->hasRole('comercial'))
                    <div class="card shadow col-sm-12 col-md-5 col-lg-3 mx-3 text-center bg-success bg-gradient my-3 mx-3">
                        <p>¡Bienvenido Comercial! Aquí encontrarás funciones para comerciales.</p>
                        <!-- Agrega aquí los elementos específicos para el rol de Comercial -->
                    </div>
                @endif

                @if (auth()->user()->hasRole('administrativo') ||
                        auth()->user()->hasRole('responsable'))
                    <div class="card shadow col-sm-12 col-md-5 col-lg-3 mx-3 text-center bg-info bg-gradient my-3 mx-3">
                        <div class="card-body d-flex flex-column align-items-center justify-content-center">
                            <h5 class="card-title">Clientes</h5>
                            <a href="#">
                                <i class="fa-solid fa-people-group fa-3x mb-3 text-dark"></i>
                            </a>
                            <a href="{{ route('dashboard.productos') }}" class="btn btn-dark mb-3">ENTRAR</a>
                        </div>
                    </div>
                    <!-- Agrega aquí los elementos específicos para el rol de Administrativo -->
                @endif

                @if (auth()->user()->hasRole('responsable'))
                    <div class="card shadow col-sm-12 col-md-5 col-lg-3 mx-3 text-center bg-info bg-gradient ">
                        <!-- Agrega aquí los elementos específicos para el rol de Responsable -->
                    </div>
                @endif
            </div>
        @endif
    </div>
@endsection

@section('footer', '©️ Cervezas killer')
