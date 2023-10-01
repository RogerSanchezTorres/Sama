<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('/style/products/details.css') }}">

</head>

<body>

    <x-header />
    <x-headersama />
    <x-nav />

    <div class="product-detail-container">
        <div class="product-image">
            @if ($product->img)
            <img src="{{ asset($product->img) }}" alt="{{ $product->nombre_es }}">
            @else
            <div class="no-image">
                No hay imagen disponible
            </div>
            @endif
        </div>
        <div class="product-info">
            <h1 class="product-title">{{ $product->nombre_es }}</h1><br>
            <p class="product-price">Precio: {{ $product->precio_es }}€</p>
            @if (auth()->check())
            <button>Comprar</button>
            @else
            <p class="login">Por favor, inicie sesión para comprar.</p>
            <a href="{{ route('login') }}">Iniciar sesión</a>
            @endif
        </div>
    </div>

    <x-footer />

</body>

</html>