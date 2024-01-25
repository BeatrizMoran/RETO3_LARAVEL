<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <!-- Enlace al archivo CSS de Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .nav-pills li a:hover{
            background-color: blue;
        }

        .card-body i:hover {
        transform: scale(1.2); /* Ajusta el valor para el aumento de tamaño deseado */
    }
        </style>
</head>

<body>

    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="bg-dark col-auto col-md-4 col-lg-2  min-vh-100">
                <div class="bg-dark p-2">
                    @auth
                    <div class="d-flex flex-column align-items-center text-white">
                        <img src="{{ Auth::user()->foto }}" alt="Foto de perfil" class="rounded-circle mb-2" width="50">
                        <span class="fs-5">{{ Auth::user()->email }}</span>
                    </div>
                @endauth
                    <a class="d-flex text-decoration-none mt-1 align-items-center text-white">
                        <span class="fs-4 d-none d-sm-inline">SideMenu</span>
                        <ul class="nav nav-pills flex-column mt-4">
                            <li class="nav-item">
                                <a href="#" class="nav-link text-white" aria-current="page">Pedidos</a>
                                <i class="fs-5 fa fa-guage"></i><span class="fs-4 ms-1 d-none d-sm-inlineDashboard"></span>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link text-white" aria-current="page">Productos</a>
                                <i class="fs-5 fa fa-guage"></i><span class="fs-4 d ms-1-none d-sm-inlineDashboard"></span>
                            </li>
                            <li class="nav-item ">
                                <a href="#" class="nav-link text-white" aria-current="page">Usuarios</a>
                                <i class="fa-solid fa-user"></i></span>
                            </li>
                            <li class="nav-item ">
                                <a href="{{ route('clientes.index') }}" class="nav-link text-white" aria-current="page">Clientes</a>
                                <i class="fa-solid fa-user"></i><span class="fs-4 ms-1 d-none d-sm-inlineDashboard"></span>
                            </li>
                            <li class="nav-item">
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" >
                                @csrf
                                <button type="submit" class="nav-link" >Cerrar sesión</button>
                            </form>
                        </li>
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
