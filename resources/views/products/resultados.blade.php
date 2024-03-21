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


    @if ($resultados->isEmpty())
    <p>No se encontraron resultados para la búsqueda.</p>
    @else

    <h1>Resultados de búsqueda para <b>{{ $terminoBusqueda }}</b></h1>

    <div class="productos">
        @foreach($resultados as $resultado)
        <a href="{{ route('products.showDetail', ['id' => $resultado->id]) }}">
            <div class="producto">
                <img src="{{ asset($resultado->img) }}" alt="{{ $resultado->nombre_es }}" class="producto-imagen">
                <h2 class="producto-nombre">{{ $resultado->nombre_es }}</h2>
                <p class="producto-precio">Precio: {{ $resultado->precio_es }}€</p>
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