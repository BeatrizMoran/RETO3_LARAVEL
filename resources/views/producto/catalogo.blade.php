@extends('layouts.app')

@section('title', 'Catalogo productos')

@section('content')
<div class="container">
    <div class="row">
        @forelse ($productos as $producto)
            <div class="col-lg-4 col-md-6 mb-4">
                @component("_components.productoCard")
                    @slot("imagen", $producto->imagen)
                    @slot("nombre", $producto->nombre)
                    @slot("precio", $producto->precio)
                    @slot("formato", $producto->formato)
                @endcomponent
            </div>
        @empty
            <div class="col-12">
                <h1>no hay productos</h1>
            </div>
        @endforelse
    </div>
</div>

@endsection

@section('footer', '©️ Cervezas killer')
