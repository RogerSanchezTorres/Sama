<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('img/logos sama/logosama.jpg') }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('/style/admin/category.css') }}">
</head>

<body>

    <x-header />
    <x-headersama />
    <x-nav />
    <x-header-admin />

    <h2>Crear Categoria</h2>

    <div class="form-category">
        <form method="POST" action="{{ route('admin-store-maincategory') }}">
            @csrf

            <div class="form-group">
                <label for="nombre">Nombre de la Categoria:</label>
                <input type="text" name="nombre" id="nombre" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="slug">Slug: (Repetir el nombre)</label>
                <input type="text" id="slug" name="slug" required>
            </div>


            <div class="crear">
                <button type="submit" class="btn btn-primary">Crear Categoria</button>
            </div>

        </form>
    </div>

    <x-footer />
    <script src="{{ asset('js/desplegable.js') }}"></script>
</body>

</html>