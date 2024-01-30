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
@endsection

@section('footer', '©️ Cervezas killer')
