<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('img/logos sama/logosama.jpg') }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('/style/admin/delete.css') }}">
</head>

<body>

    <x-header />
    <x-headersama />
    <x-nav />
    <x-header-admin />

    <h2>Editar Apartado</h2>
    <form action="{{ route('apartados.update', $apartado) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="text" name="nombre" value="{{ $apartado->nombre }}" required>
        <button type="submit">Actualizar</button>
    </form>





    <x-footer />
    <script src="{{ asset('js/desplegable.js') }}"></script>
</body>

</html>