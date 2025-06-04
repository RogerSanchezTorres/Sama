<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('img/logos sama/logosama.jpg') }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('/style/admin/apartados.css') }}">
</head>

<body>

    <x-header />
    <x-headersama />
    <x-nav />
    <x-header-admin />

    @if(session('success'))
    <div class="alert-success">
        {{ session('success') }}
    </div>
    @endif

    <h2 class="apartados-title">Apartados</h2>
    <a href="{{ route('apartados.create') }}" class="btn-create">Crear nuevo apartado</a>

    <ul class="apartados-list">
        @foreach($apartados as $apartado)
        <li class="apartado-item">
            <span class="apartado-nombre">{{ $apartado->nombre }}</span>

            <div class="apartado-actions">
                <a href="{{ route('apartados.edit', $apartado->id) }}" class="btn-edit">Editar</a>

                <form action="{{ route('apartados.destroy', $apartado->id) }}" method="POST" class="form-delete" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este apartado?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-delete">Eliminar</button>
                </form>
            </div>
        </li>
        @endforeach
    </ul>





    <x-footer />
    <script src="{{ asset('js/desplegable.js') }}"></script>
</body>

</html>