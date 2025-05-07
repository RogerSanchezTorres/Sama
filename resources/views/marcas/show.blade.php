<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{ asset('img/logos sama/logosama.jpg') }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    <link rel="stylesheet" href="{{ asset('style/index.css') }}">

</head>

<body>
    <x-header />
    <x-headersama />

    <x-nav />

    <div class="container">
        <h1>Productos de {{ $marca }}</h1>

        <div class="row">
            @foreach($products as $product)
            <div class="col-md-3 mb-4 text-center">
                <div class="card h-100">
                    <img src="{{ asset('storage/' . $product->img) }}" class="card-img-top" alt="{{ $product->nombre_es }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->nombre_es }}</h5>
                        <p class="card-text">{{ $product->precio_es }} €</p>
                        {{-- Puedes añadir más info o botones --}}
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>



    <x-footer />

</body>

</html>