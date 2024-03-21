<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('img/logos sama/logosama.jpg') }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('/style/products/index.css') }}">

</head>

<body>

    <x-header />
    <x-headersama />
    <x-nav />

    @foreach($categories as $category)
    <div id="{{ $category->slug }}">
        <a href="{{ route('products.showByMainCategory', ['mainCategoryId' => $mainCategory->id]) }}">{{ $mainCategory->nombre }}</a>
    </div>
    @endforeach


    <x-footer />

</body>

</html>