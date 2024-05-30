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
    <style>

    </style>
</head>

<body>

    <x-header />
    <x-headersama />
    <x-nav />
    <x-header-admin />
    <h2>Crear Subcategoria</h2>
    <div class="form-category">
        <form action="{{ route('admin.store.category') }}" method="POST">
            @csrf
            <div>
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required>
            </div>
            <div>
                <label for="slug">Slug: (Repetir el nombre)</label>
                <input type="text" id="slug" name="slug" required>
            </div>
            <div>
                <label for="main_category_id">Categoría principal:</label>
                <select id="main_category_id" name="main_category_id" required>
                    @foreach($mainCategories as $mainCategory)
                    <option value="{{ $mainCategory->id }}">{{ $mainCategory->nombre }}</option>
                    @endforeach
                </select>
            </div><br>
            <div class="crear">
                <button type="submit">Crear Categoría</button>
            </div>
        </form>
    </div>

    <x-footer />
    <script src="{{ asset('js/desplegable.js') }}"></script>
</body>

</html>