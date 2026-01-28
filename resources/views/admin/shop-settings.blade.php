<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('img/logos sama/logosama.jpg') }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('/style/admin/admin-shop.css') }}">
</head>

<body>
    <x-header />
    <x-headersama />
    <x-nav />
    <x-header-admin />

    <div class="container">
        <h2 class="mb-4">Estado de la tienda</h2>

        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <div class="card">
            <div class="card-body">
                <p class="mb-3">
                    Estado actual:
                    <strong class="{{ $enabled ? 'text-success' : 'text-danger' }}">
                        {{ $enabled ? 'TIENDA ACTIVA' : 'MODO CATÁLOGO' }}
                    </strong>
                </p><br>

                <form method="POST" action="{{ route('admin.shop.toggle') }}">
                    @csrf
                    <button class="btn {{ $enabled ? 'btn-danger' : 'btn-success' }}">
                        {{ $enabled ? 'Desactivar tienda' : 'Activar tienda' }}
                    </button>
                </form><br>
            </div>
        </div>

        @if(!$enabled)
        <div class="alert alert-info mt-4">
            La web se muestra como catálogo. Los precios y la compra están deshabilitados.
        </div>
        @endif
    </div>
    
    <x-footer />

    <script src="{{ asset('js/desplegable.js') }}"></script>
</body>

</html>