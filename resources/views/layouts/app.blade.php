<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="{{ asset('storage/images/favicon.ico') }}">

    <title>@yield('title')</title>
    @vite(['resources/sass/app.scss'])
</head>

<body class="d-flex flex-column mainClass" style="min-height: 100vh;">

    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('welcome') }}">
                    <img src="{{ asset('storage/images/Killerlogo.png') }}" class="img-fluid" alt="LogoKiller"
                        width="50" height="50">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav me-auto my-2 my-lg-0 " style="--bs-scroll-height: 100px;"">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('welcome') }}">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('productos.catalogo') }}">Catalogo</a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Sobre nosotros
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item" href="#">Empresa</a></li>
                                <li><a class="dropdown-item" href="#">Servicios</a></li>
                                <li><a class="dropdown-item" href="#">Terminos legales</a></li>
                            </ul>
                        </li>
                    </ul>
                    <div class="d-flex ">
                        <a class="btn btn-success" href="login">Iniciar sesion</a>
                    </div>
                </div>

            </div>
        </nav>
    </header>

    <main >
        @yield('content')
    </main>

    <footer class="bg-dark text-center text-white py-4 mt-auto">
        <div class="container">
            @yield('footer')
        </div>
    </footer>
    <!-- Mensaje de Consentimiento de Cookies -->
    <div id="cookieConsentContainer" class="fixed-bottom bg-light p-3 text-center" style="display: none;">
        <p>Este sitio utiliza cookies para mejorar la experiencia del usuario. <a href="#">Más información</a>.
        </p>
        <button id="acceptCookie" class="btn btn-primary">Aceptar</button>
        <button id="declineCookie" class="btn btn-secondary">Rechazar</button>
    </div>


    @vite(['resources/js/app.js']) @vite(['resources/js/buscar.js'])
</body>

</html>
