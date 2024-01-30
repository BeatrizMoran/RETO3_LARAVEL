@extends('layouts.app')

@section('title', 'Cerveza killer')

@section('content')

    <div id="carruselWelcome" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carruselWelcome" data-bs-slide-to="0" class="active" aria-current="true"
                aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carruselWelcome" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carruselWelcome" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('storage/images/carrusel 1.png') }}" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Producto de calidad</h5>
                    <p>Descubre la excelencia y el compromiso detrás de cada una de nuestras cervezas. Calidad que puedes
                        saborear en cada sorbo, resultado de ingredientes seleccionados y un proceso de elaboración
                        perfeccionado con años de experiencia.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('storage/images/carrusel 2.png') }}" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Sabor artesano</h5>
                    <p>Experimenta el gusto auténtico de lo hecho a mano con nuestras cervezas artesanales. Cada lote es una
                        obra de arte, fusionando tradición y creatividad para ofrecerte una experiencia única y un sabor
                        inigualable que solo el toque artesano puede proporcionar.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('storage/images/carrusel 3.png') }}" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Variedad</h5>
                    <p>Nuestra selección de cervezas es un viaje de sabores. Desde las más clásicas hasta las más
                        innovadoras, hay una cerveza para cada paladar. Descubre la amplia gama de estilos y encuentra tu
                        favorita. La variedad es el sabor de la vida y la base de nuestra colección.</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carruselWelcome" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carruselWelcome" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>



    <!-- Contenido Principal -->
    <div class="row">
        <div class="col m-4 ">
            <h1>Bienvenido a Nuestro Sitio</h1>
            <p>Este es un ejemplo de página de bienvenida utilizando Bootstrap 5.</p>
            <!-- Más contenido aquí -->
        </div>
        <div class="col m-4">
            <h1>Bienvenido a Nuestro Sitio</h1>
            <p>Este es un ejemplo de página de bienvenida utilizando Bootstrap 5.</p>
            <!-- Más contenido aquí -->
        </div>
    </div>

    <!-- Modal de Consentimiento de Cookies -->
    <div id="cookieConsentModal" class="modal" tabindex="-1" role="dialog" style="display:none;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Consentimiento de Cookies</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closeModal()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Este sitio web utiliza cookies para asegurar que obtengas la mejor experiencia en nuestro sitio web.
                    </p>
                    <p>Las cookies son pequeños archivos de texto que los sitios web pueden usar para hacer que la
                        experiencia del usuario sea más eficiente. La ley establece que podemos almacenar cookies en tu
                        dispositivo si son estrictamente necesarias para el funcionamiento de este sitio. Para todos los
                        demás tipos de cookies necesitamos tu permiso.</p>
                    <p>Al aceptar, estás consintiendo el uso de cookies. Si eliges rechazar, no almacenaremos cookies que no
                        sean esenciales para el funcionamiento del sitio.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="acceptCookie">Aceptar</button>
                    <button type="button" class="btn btn-secondary" id="declineCookie">Cancelar</button>
                </div>
            </div>
        </div>
    </div>

@endsection
@vite(['resources/js/cookies.js'])
@section('footer', '©️ Cervezas killer')
