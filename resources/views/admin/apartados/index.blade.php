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

    <h2>Apartados</h2>
    <a href="{{ route('apartados.create') }}">Crear nuevo apartado</a>

    <ul>
        @foreach($apartados as $apartado)
        <li>
            {{ $apartado->nombre }}
            <a href="{{ route('apartados.edit', $apartado) }}">Editar</a>
            <form action="{{ route('apartados.destroy', $apartado) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit">Eliminar</button>
            </form>
        </li>
        @endforeach
    </ul>



    <x-footer />
    <script src="{{ asset('js/desplegable.js') }}"></script>
</body>

</html>