@extends('layouts.panelAdministracion')

@section('title', 'Página Específica')

@section('content')
    <div class=" dashboard">


        @auth
            <div class="welcome-message p-4 mb-4 bg-light border rounded m-4">
                <h1 class="display-3"> <strong>¡Bienvenido al panel de gestión!</strong></h1>
                <p class="lead">Hola, <strong>{{ auth()->user()->name }}</strong>. Es un placer tenerte con nosotros.</p>
                <hr class="my-2">
                <p>En Killer, estamos comprometidos con la excelencia y tu crecimiento profesional. Explora, colabora y crece
                    con nosotros.</p>
                <p>Si necesitas asistencia o tienes alguna pregunta, no dudes en contactar al equipo de soporte.</p>

            </div>

            <div class="row d-flex justify-content-center">
                @role('responsable|administrativo|comercial')
                    <div class="col-sm-12 col-md-5 col-lg-3 mx-3 my-3">
                        <div class="card shadow h-100 text-center bg-primary bg-gradient">
                            <div class="card-body d-flex flex-column align-items-center justify-content-center">
                                <h5 class="card-title text-white">Productos</h5>
                                <a href="#" class="text-white">
                                    <i class="fa-solid fa-list-check fa-3x mb-3"></i>
                                </a>
                                <a href="{{ route('dashboard.productos') }}" class="btn btn-light">ENTRAR</a>
                            </div>
                        </div>
                    </div>
                @endrole

                @role('responsable|administrativo|comercial')
                    <div class="col-sm-12 col-md-5 col-lg-3 mx-3 my-3">
                        <div class="card shadow h-100 text-center bg-success bg-gradient">
                            <div class="card-body d-flex flex-column align-items-center justify-content-center">
                                <h5 class="card-title text-white">Pedidos</h5>
                                <a href="#" class="text-white">
                                    <i class="fa-solid fa-clipboard fa-3x mb-3"></i>
                                </a>
                                <a href="{{ route('pedidos.index') }}" class="btn btn-light">ENTRAR</a>
                            </div>
                        </div>
                    </div>
                @endrole
                @role('responsable|administrativo')
                    <div class="col-sm-12 col-md-5 col-lg-3 mx-3 my-3">
                        <div class="card shadow h-100 text-center bg-danger bg-gradient">
                            <div class="card-body d-flex flex-column align-items-center justify-content-center">
                                <h5 class="card-title text-white">Clientes</h5>
                                <i class="fa-solid fa-people-group fa-3x mb-3 text-white"></i>
                                <a href="{{ route('clientes.index') }}" class="btn btn-light">ENTRAR</a>
                            </div>
                        </div>
                    </div>
                @endrole

                @role('responsable')
                    <div class="col-sm-12 col-md-5 col-lg-3 mx-3 my-3">
                        <div class="card shadow h-100 text-center bg-info bg-gradient">
                            <div class="card-body d-flex flex-column align-items-center justify-content-center">
                                <h5 class="card-title text-white">Usuarios</h5>
                                <i class="fa-solid fa-users fa-3x mb-3 text-white"></i>
                                <a href="{{ route('usuarios.index') }}" class="btn btn-light">ENTRAR</a>
                            </div>
                        </div>
                    </div>
                @endrole
            </div>
        @endauth
    </div>
@endsection

@section('footer', '©️ Cervezas killer')
