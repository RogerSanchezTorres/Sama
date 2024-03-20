<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('/style/contacto/contacto.css') }}">

</head>

<body>

    <x-header />
    <x-headersama /> 
    <x-nav />


    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="container">
        <div class="contact-form">
            <h2>Formulario de contacto</h2>
            <form method="POST" action="{{ route('submit') }}" enctype="multipart/form-data"> 
                @csrf
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" placeholder="Nombre">

                <label for="email">Correo electrónico</label>
                <input type="email" name="email" id="email" placeholder="Correo electrónico">

                <label for="imagen">Adjuntar imagen</label>
                <input type="file" name="imagen" id="imagen"><br><br>

                <label for="mensaje">Mensaje</label>
                <textarea name="mensaje" id="mensaje" placeholder="En que podemos ayudarte?"></textarea>

                <input type="submit" value="Enviar">
            </form>
        </div>
    </div>

    <x-footer />
    <script src="{{ asset('js/desplegable.js') }}"></script>
</body>

</html>