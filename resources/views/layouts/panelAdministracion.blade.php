<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    @vite(['resources/sass/app.scss'])
    @vite(['resources/css/app.css'])
</head>

<body>

    <div class="container-fluid ">
        <div class="row flex-nowrap min-vh-100">
            <div class="col-auto d-flex flex-column bg-gradient min-vh-100 light-bg ">
                <div class="p-4 text-center">
                    <a href="#" class="d-block mb-3 text-decoration-none">
                        <img src="{{ asset('storage/images/Killerlogo.png') }}" width="50" height="50"
                            class="img-fluid" alt="">
                        <span class="fs-4 d-none d-md-inline ">Cervezas Killer</span>
                    </a>
                    <hr class="w-100">
                </div>

                @auth
                    <ul class="nav nav-pills flex-column flex-grow-1">
                        @role('responsable|administrativo|comercial')
                            <li class="nav-item m-2 p-2">
                                <a href="{{ route('dashboard.productos') }}"
                                    class="nav-link{{ request()->is('dashboard/productos') ? ' active' : '' }}">
                                    <i class="fa-solid fa-list-check  me-3 fs-5 p-1"></i>
                                    <span class="d-none d-md-inline p-1 ">Productos</span>
                                </a>
                            </li>
                        @endrole
                        @role('responsable|administrativo|comercial')
                            <li class="nav-item m-2 p-2">
                                <a href="{{ route('pedidos.index') }}"
                                    class="nav-link{{ request()->is('pedidos') ? ' active' : '' }}">
                                    <i class="fa-solid fa-clipboard me-3 fs-5 p-1"></i>
                                    <span class="d-none d-md-inline p-2">Pedidos</span>
                                </a>
                            </li>
                        @endrole

                        @role('responsable|administrativo')
                            <li class="nav-item m-2 p-2">
                                <a href="{{ route('clientes.index') }}"
                                    class="nav-link{{ request()->is('clientes') ? ' active' : '' }}">
                                    <i class="fa-solid fa-people-group  me-3 fs-5 p-1"></i>
                                    <span class="d-none d-md-inline">Clientes</span>
                                </a>
                            </li>
                        @endrole
                        @role('responsable')
                            <li class="nav-item m-2 p-2">
                                <a href="{{ route('usuarios.index') }}"
                                    class="nav-link{{ request()->is('/usuarios') ? ' active' : '' }}">
                                    <i class="fa-solid fa-users  me-3 fs-5 p-1"></i>
                                    <span class="d-none d-md-inline ">Usuarios</span>
                                </a>
                            </li>
                            <li class="nav-item m-2 p-2">
                                <a href="{{ route('roles.index') }}"
                                    class="nav-link{{ request()->is('/usuarios') ? ' active' : '' }}">
                                    <i class="fa-solid fa-list  me-3 fs-5 p-1"></i>
                                    <span class="d-none d-md-inline  p-1">Roles</span>
                                </a>
                            </li>
                        @endrole
                        <!-- Repite la estructura para otros roles y enlaces -->
                    </ul>
                    <div class="mt-auto p-4">
                        <div class="d-flex align-items-center">
                            <div class="dropdown">
                                <a href="#"
                                    class="d-flex align-items-center text-light text-decoration-none dropdown-toggle"
                                    id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="{{ asset('storage/images/Killerlogo.png') }}" alt="" width="32"
                                        height="32" class="rounded-circle me-2">
                                    <strong>{{ auth()->user()->name }}</strong>
                                </a>
                                <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser">
                                    <li><a class="dropdown-item" href="{{ route('perfil') }}">Perfil</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-danger w-80 m-2">
                                                <i class="fa-solid fa-right-from-bracket me-2"></i>Cerrar sesión
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                            <!-- Toggle aquí -->
                            <label class="switch ms-3" for="dark-mode-toggle">
                                <input type="checkbox" id="dark-mode-toggle">
                                <span class="slider">
                                    <i class="fas fa-moon"></i>
                                    <i class="fas fa-sun"></i>
                                </span>
                            </label>
                            <!-- Fin del toggle -->
                        </div>
                    </div>


                @endauth
            </div>

            <main class="col px-md-4 min-vh-100">
                @include('layouts._partials.messages')
                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://kit.fontawesome.com/2f23627a24.js" crossorigin="anonymous"></script>
    @vite(['resources/js/app.js'])
</body>

</html>
