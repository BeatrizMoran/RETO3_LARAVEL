<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('storage/images/favicon.ico') }}">

    <title>@yield('title')</title>
    @vite(['resources/sass/app.scss'])
</head>

<div class="container-fluid">
    <nav class=" row navbar navbar-expand-lg navbar-dark bg-dark d-flex justify-content-between">
        <div class="col-12">
            <a class="navbar-brand" href="{{ route('welcome') }}">
                <img src="{{ asset('storage/images/Killerlogo.png') }}" alt="LogoKiller" width="50"
                    height="50">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
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
            </div>
            <div class="d-flex mx-4">
                <a class="btn btn-success" href="login">Iniciar sesion</a>
            </div>
        </div>
    </nav>

    <div class="row">
        <div class="col">
            @yield('content')
        </div>
    </div>
    <div class="row">
        <div class="col">
            @yield('footer')

        </div>

    </div>
    <div class="row">
        <div id="cookieConsentContainer" class=" fixed-bottom bg-light p-3 text-center" style="display: none;">
            <p>Este sitio utiliza cookies para mejorar la experiencia del usuario. <a href="#">Más información</a>.</p>
            <button id="acceptCookie" class="btn btn-primary">Aceptar</button>
            <button id="declineCookie" class="btn btn-secondary">Rechazar</button>
        </div>
    </div>

    @vite(['resources/js/app.js'])

</div>

</html>
