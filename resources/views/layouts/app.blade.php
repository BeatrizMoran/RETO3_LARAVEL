<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @vite(['resources/sass/app.scss'])
</head>

<body class="bg-light d-flex flex-column" style="min-height: 100vh;"> <!-- Ajuste para la altura y flexibilidad -->

    <header>
        <!-- Navbar de Bootstrap -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
            <div class="container">
                <!-- Brand -->
                <a class="navbar-brand" href="#">
                    <img src="" width="30" height="30" class="d-inline-block align-top" alt="">
                    Cerveza Killer
                  </a>
                <!-- Toggler/Collapsible Button -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupported"
                    aria-controls="navbarSupported" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- Navbar links -->
                <div class="collapse navbar-collapse" id="navbarSupported">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route("productos.index") }}">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Productos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Sobre nosotros</a>
                        </li>
                        <li class="nav-item">
                            <div class="ml-auto" style="width: 200px; display: flex; justify-content: flex-end;margin-left:70%">
                                <a class="nav-link" href="{{ route("login") }}">Iniciar sesión</a>
                                <a class="nav-link" href="{{ route("register") }}">Registrarme</a>
                            </div>
                        </li>
                        <!-- Más elementos del menú aquí -->
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main class="container my-4 flex-grow-1"> <!-- Ajuste para crecimiento flexible -->
        @yield('content')
    </main>

    <footer class="bg-white text-center text-dark py-4 mt-auto"> <!-- Clase mt-auto para empujar al fondo -->
        <div class="container">
            @yield('footer')
        </div>
    </footer>

    @vite(['resources/js/app.js'])
</body>

</html>
