<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    @vite(['resources/sass/app.scss'])

    @vite(['resources/css/app.css'])




</head>

<body >

    <div class="container-fluid ">
        <div class="row flex-nowrap min-vh-100">
            <div class="bg-light bg-gradient col-auto  d-flex justify-content-center align-items-center min-vh-100" >
                <div class="bg-dark bg-gradient rounded-4 p-4 min-vh-100 w-100">
                    <a class="d-flex text-decoration-none mt-1 align-items-center text-white">
                        <img src="{{ url('Killerlogo.png') }}" width="30" height="30"
                            class="d-inline-block align-top me-3" alt="">
                        <span class="fs-2 d-none d-md-inline ">Cervezas killer</span>
                    </a>
                    <hr class="border-bottom border-gray-500 border-opacity-50 w-95 my-4">

                @auth
                    <ul class="nav nav-pills flex-column mt-4 min-vh-100">
                        <li class="nav-item my-3">
                            <a href="{{ route('dashboard.productos') }}"
                                class="nav-link{{ request()->is('dashboard/productos') ? ' active' : '' }}">
                                <i class="fa-solid fa-list-check  me-3 fs-5"></i>
                                <span class="d-none d-md-inline">Productos</span>
                            </a>
                        </li>
                        <li class="nav-item my-3">
                            <a href="{{route('pedidos.index')}}" class="nav-link{{ request()->is('dashboard/pedidos') ? ' active' : '' }}">
                                <i class="fa-solid fa-clipboard me-3 fs-5"></i>
                                <span class="d-none d-md-inline">Pedidos</span>
                            </a>
                        </li>
                @role('responsable|administrativo')

                        <li class="nav-item my-3">
                            <a href="{{ route('clientes.index') }}"
                                class="nav-link{{ request()->is('clientes') ? ' active' : '' }}">
                                <i class="fa-solid fa-people-group  me-3 fs-5"></i>
                                <span class="d-none d-md-inline">Clientes</span>
                            </a>
                        </li>
                @endrole
                @role('responsable')

                        
                        <li class="nav-item my-3">
                            <a href="{{ route('usuarios.index') }}" class="nav-link{{ request()->is('/usuarios') ? ' active' : '' }}">
                                <i class="fa-solid fa-user  me-3 fs-5"></i>
                                <span class="d-none d-md-inline">Usuarios</span>
                            </a>
                        </li>
                @endrole
                        <li class="nav-item my-3">
                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="nav-link">
                                    <i class="fa-solid fa-right-from-bracket fs-5"></i>
                                </button>
                            </form>
                        </li>
                        <div class="dropdown d-none d-md-block">
                            <a href="#"
                                class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                                id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{ url('Killerlogo.png') }}" alt="" width="32" height="32"
                                    class="rounded-circle me-2">
                                <strong>{{ auth()->user()->name }}</strong>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark text-small shadow"
                                aria-labelledby="dropdownUser1">
                                <li><a class="dropdown-item" href="#">New project...</a></li>
                                <li><a class="dropdown-item" href="#">Settings</a></li>
                                <li><a class="dropdown-item" href="{{ route('perfil') }}">Profile</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#">Sign out</a></li>
                            </ul>
                        </div>
                    </ul>
                @endauth
                </div>
            </div>
            <main class="col-sm-auto col-md-9 col-lg-10 px-md-4 min-vh-100">
                @include('layouts._partials.messages')

                @yield('content')

            </main>
        </div>
    </div>



    <!-- Contenido Principal -->
    <script src="https://kit.fontawesome.com/2f23627a24.js" crossorigin="anonymous"></script>
    <!-- Enlace al archivo JS de Bootstrap 5 y Popper.js (necesario para algunas funcionalidades) -->
    @vite(['resources/js/app.js'])
</body>

</html>
