<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('/style/empresa/nosotros.css') }}">

</head>

<body>

    <x-header />
    <x-headersama /> 
    <x-nav />

    <div class="somos">
        <h2>Quiénes somos</h2>
    </div>

    <div id="nuestra-empresa">
        <div class="informacion-empresa">
            <h3>Nuestra empresa</h3>
            <p class="p1">Somos una empresa creada en 2013, pero con una experiencia de 30 años en el sector de la venta de materiales para la construcción, fontanería, electricidad, cerámica y sanitario.</p>
            <p class="p2">Contamos con más de 2000 mts cuadrados de almacén con más de 10000 referencias en stock de primeras marcas.</p>
            <div class="lista">
                <li type="disc">Productos de alta calidad</li>
                <li type="disc">El mejor servicio de atención al cliente</li>
            </div>

            <h3>Nuestro equipo</h3>
            <p>Tenemos un equipo que te ayudará a resolver las dudas y te aconsejarán sobre tus necesidades.</p>
        </div>
        <div class="imagen-empresa">
            <img src="{{ asset('img/sama.png') }}" alt="Subministres Sama">
        </div>

    </div>


    <x-footer />

</body>

</html>