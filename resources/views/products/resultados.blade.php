<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('img/logos sama/logosama.jpg') }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('/style/products/resultados.css') }}">

</head>

<body>

    <x-header />
    <x-headersama />
    <x-nav />

    @php($shopEnabled = \App\Models\Setting::enabled()) @endphp


    @if ($resultados->isEmpty())
    <p>No se encontraron resultados para la búsqueda.</p>
    @else

    <h1>Resultados de búsqueda para <b>{{ $terminoBusqueda }}</b></h1>

    <div class="productos">
        @foreach($resultados as $resultado)
        <a href="{{ route('products.showDetail', ['id' => $resultado->id]) }}">
            <div class="producto">
                <div class="image-container">
                    @php
                    // Decodificamos las imágenes del producto si es JSON
                    $images = json_decode($resultado->img, true);

                    // Si la imagen no es JSON, asumimos que es un producto antiguo con una imagen única
                    if (json_last_error() !== JSON_ERROR_NONE || !is_array($images)) {
                    $images = [$resultado->img];
                    }
                    @endphp

                    @if (!empty($images) && is_array($images))
                    <img src="{{ asset($images[0]) }}" alt="{{ $resultado->nombre_es }}">
                    @else
                    <div class="no-image">No hay imagen disponible</div>
                    @endif
                </div>
                <h2 class="producto-nombre">{{ $resultado->nombre_es }}</h2>
                @if (auth()->check() && auth()->user()->role)
                @if (auth()->user()->role->role === 'profesional')
                @if($shopEnabled)
                <span class="price">{{ $resultado->precio_oferta_es }} €</span>
                @endif
                @else
                @if($shopEnabled)
                <span class="price">{{ $resultado->precio_es }} €</span>
                @endif
                @endif
                @endif
            </div>
        </a>
        @endforeach
    </div>
    @endif

    <div class="pagination">
        {{ $resultados->appends(request()->query())->links() }}
    </div>



    <x-footer />
    <script src="{{ asset('js/desplegable.js') }}"></script>

</body>

</html>