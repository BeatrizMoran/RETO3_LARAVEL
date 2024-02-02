@extends('layouts.app')

@section('title', 'Catálogo de productos')

@section('content')

<div class="row mt-4">
    <aside class="col-lg-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Filtrar por categoría</h5>
                <form id="filter-form" method="GET" action="{{ route('productos.catalogo') }}">
                    @foreach ($categorias as $categoria)
                        <div class="form-check">
                            <input class="form-check-input categoria-checkbox" type="checkbox" name="categorias[]"
                                id="categoria_{{ $categoria->id }}" value="{{ $categoria->id }}"
                                @if (in_array($categoria->id, $categoriasSeleccionadas)) checked @endif>
                            <label
                                class="form-check-label categoria-label @if (in_array($categoria->id, $categoriasSeleccionadas)) categoria-filtrada @endif"
                                for="categoria_{{ $categoria->id }}">
                                {{ $categoria->nombre }}
                            </label>
                        </div>
                    @endforeach

                    <button type="submit" class="btn btn-primary mt-3">Filtrar</button>
                </form>
            </div>
        </div>
    </aside>

    <div class="col-lg-9">
        <div class="row">
            @forelse ($productos as $producto)
                <div class="col-lg-4 col-md-6 mb-4">
                    @component('_components.productoCard')
                        @slot('imagen', $producto->imagen)
                        @slot('nombre', $producto->nombre)
                        @slot('precio', $producto->precio)
                        @slot('formato', $producto->formato)
                        @slot('categorias', $producto->categorias)
                    @endcomponent
                </div>
                @empty
                    <div class="col-12">
                        <h1>No hay productos</h1>
                    </div>
                @endforelse
            </div>
            @if (count($productos) !== 0)
                <div class="d-flex justify-content-center">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            @if ($productos->previousPageUrl())
                                <li class="page-item">
                                    <a class="page-link"
                                        href="{{ $productos->appends(request()->except('page'))->previousPageUrl() }}"
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                            @endif

                            @if ($productos->currentPage() > 3)
                                <li class="page-item"><span class="page-link">1</span></li>
                                <li class="page-item disabled"><span class="page-link">...</span></li>
                            @endif

                            @for ($i = max(1, $productos->currentPage() - 2); $i <= min($productos->lastPage(), $productos->currentPage() + 2); $i++)
                                <li class="page-item @if ($i == $productos->currentPage()) active @endif">
                                    <a class="page-link"
                                        href="{{ $productos->appends(request()->except('page'))->url($i) }}">{{ $i }}</a>
                                </li>
                            @endfor

                            @if ($productos->currentPage() < $productos->lastPage() - 2)
                                <li class="page-item disabled"><span class="page-link">...</span></li>
                                <li class="page-item"><span class="page-link">{{ $productos->lastPage() }}</span></li>
                            @endif

                            @if ($productos->nextPageUrl())
                                <li class="page-item">
                                    <a class="page-link"
                                        href="{{ $productos->appends(request()->except('page'))->nextPageUrl() }}"
                                        aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </nav>
                </div>
            @endif

        </div>
    </div>
</div>


    @endsection

    @section('footer', '©️ Cervezas Killer')
