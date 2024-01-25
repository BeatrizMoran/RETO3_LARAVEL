<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <!-- Enlace al archivo CSS de Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">


    <style>
            .nav-pills li {
                margin-bottom: 10px;
            }

            .nav-pills li a {
                background-color: transparent;
            }

            i, span{
                color:white;
            }

            .nav-pills li a.active,
            .nav-pills li a:hover {
                background-color: blue;
                color: white;

            }

            .card-body i:hover {
                transform: scale(1.2);
            }

            .page-link{
                background: darkgray;
            }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="bg-dark col-auto col-md-4 col-lg-2  min-vh-100">
                <div class="bg-dark p-2">
                    <a class="d-flex text-decoration-none mt-1 align-items-center text-white">
                        <img src="{{url('r1.jpg')}}" width="30" height="30" class="d-inline-block align-top me-3" alt="">
                        <span class="fs-4 d-none d-sm-inline">Cerveza killer</span>
                  </a>
                        <ul class="nav nav-pills flex-column mt-4">
                            <li class="nav-item my-3">
                                <a href="{{ route('dashboard.productos') }}" class="nav-link{{ request()->is('dashboard/productos') ? ' active' : '' }}">
                                    <i class="fa-solid fa-list-check  me-3 fs-5"></i>
                                    <span class="d-none d-md-inline">Productos</span>
                                </a>
                            </li>
                            <li class="nav-item my-3">
                                <a href="#" class="nav-link{{ request()->is('dashboard/pedidos') ? ' active' : '' }}">
                                    <i class="fa-solid fa-clipboard me-3 fs-5"></i>
                                    <span class="d-none d-md-inline">Pedidos</span>
                                </a>
                            </li>
                            <li class="nav-item my-3">
                                <a href="#" class="nav-link{{ request()->is('dashboard/usuarios') ? ' active' : '' }}">
                                    <i class="fa-solid fa-user  me-3 fs-5"></i>
                                    <span class="d-none d-md-inline">Usuarios</span>
                                </a>
                            </li>
                            <li class="nav-item my-3">
                                <a href="{{ route('clientes.index') }}" class="nav-link{{ request()->is('dashboard/clientes') ? ' active' : '' }}">
                                    <i class="fa-solid fa-people-group  me-3 fs-5"></i>
                                    <span class="d-none d-md-inline">Clientes</span>
                                </a>
                            </li>
                            <li class="nav-item my-3">
                                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="nav-link">
                                        <i class="fa-solid fa-right-from-bracket fs-5"></i>
                                    </button>
                                </form>
                            </li>
                            <div class="dropdown d-none d-md-block">
                                <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="{{url('r1.jpg')}}" alt="" width="32" height="32" class="rounded-circle me-2">
                                    <strong>{{ auth()->user()->name }}</strong>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                                    <li><a class="dropdown-item" href="#">New project...</a></li>
                                    <li><a class="dropdown-item" href="#">Settings</a></li>
                                    <li><a class="dropdown-item" href="#">Profile</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="#">Sign out</a></li>
                                </ul>
                            </div>
                        </ul>
                    </a>
                </div>
            </div>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Contenido Principal -->
    <script src="https://kit.fontawesome.com/2f23627a24.js" crossorigin="anonymous"></script>
    <!-- Enlace al archivo JS de Bootstrap 5 y Popper.js (necesario para algunas funcionalidades) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
