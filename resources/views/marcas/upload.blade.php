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
    <link rel="stylesheet" href="{{ asset('style/marcas/upload.css') }}">

</head>

<body>
    <x-header />
    <x-headersama />

    <x-nav />
    <x-header-admin />

    <div class="upload-container">
        <h2>Subir Imagen de Marca</h2>

        @if ($errors->any())
        <div class="error-message">
            @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
            @endforeach
        </div>
        @endif

        <form action="{{ route('marcas.storeImage') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <label for="marca">Selecciona una Marca:</label>
            <select name="marca" required>
                <option value="" disabled selected>Elige una marca</option>
                @foreach($marcas as $marca)
                <option value="{{ $marca }}">{{ ucfirst($marca) }}</option>
                @endforeach
            </select>

            <label for="image">Imagen de la Marca:</label>
            <input type="file" name="image" accept="image/*" required>

            <button type="submit">Subir Imagen</button>
        </form>
    </div>







    <x-footer />

</body>

</html>