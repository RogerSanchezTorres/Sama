<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('/style/admin/add-product.css') }}">
</head>

<body>

    <x-header />
    <x-headersama />
    <x-nav />
    <x-header-admin />

    <h2>Importar Productos</h2>

    <form action="{{ route('products.import.excel') }}" method="post" enctype="multipart/form-data">
        @csrf
        <label for="excel_file">Selecciona un archivo Excel:</label>
        <input type="file" name="file">
        <button type="submit">Importar</button>

    </form>

    <x-footer />
</body>

</html>