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
    <link rel="stylesheet" href="{{ asset('style/proveedores/index.css') }}">

</head>

<body>
    <x-header />
    <x-headersama />

    <x-nav />

    <div class="container">
        <h1>Proveedores</h1>

        <div class="proveedores-grid">
            @foreach($proveedores as $proveedor)
            <div class="proveedor-card">
                <img src="{{ asset($proveedor->path) }}" alt="Logo del proveedor" width="120" height="50px" loading="lazy">
                {{-- Puedes añadir más datos si tienes --}}
            </div>
            @endforeach
        </div>
    </div>


    </div>





    <x-footer />

</body>
<script src="{{ asset('js/desplegable.js') }}"></script>

</html>