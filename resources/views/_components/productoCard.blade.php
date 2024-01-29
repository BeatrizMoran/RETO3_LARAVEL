<div class="card shadow mb-4">
    <img src="{{ $imagen }}" class="card-img-top" alt="Imagen">
    <div class="card-body">
        <h5 class="card-title"><strong>Nombre:</strong> {{ $nombre }}</h5>
        <p class="card-text"><strong>Precio:</strong> ${{ $precio }}</p>
        <p class="card-text"><strong>Formato:</strong> {{ $formato }}</p>
        <p class="card-text"><strong>Categorías:</strong>
            @foreach ($categorias as $categoria)
                <em>{{ $categoria->nombre }}</em>@if (!$loop->last), @endif
            @endforeach
        </p>
    </div>
</div>
