<div class="card shadow mb-4">
    @if (file_exists(public_path('storage/images/' . $producto->imagen)))
        <img src="{{ asset('storage/images/' . $producto->imagen) }}" alt="Producto" class="cartaCatalogo card-img-top" style="max-height: 50vh; object-fit: cover;">
    @else
        <img src="{{ asset($producto->imagen) }}" alt="Producto" class="cartaCatalogo card-img-top" style="max-height: 50vh; object-fit: cover;">
    @endif

    <div class="card-body">
        <h5 class="card-title"><strong>Nombre:</strong> {{ $nombre }}</h5>
        <p class="card-text"><strong>Precio:</strong> ${{ $precio }}</p>
        <p class="card-text"><strong>Formato:</strong> {{ $formato }}</p>
        <p class="card-text"><strong>Categorías:</strong>
            @foreach ($categorias as $categoria)
                <em>{{ $categoria->nombre }}</em>
                @if (!$loop->last)
                    ,
                @endif
            @endforeach
        </p>
    </div>
</div>
