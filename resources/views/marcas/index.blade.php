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
    <link rel="stylesheet" href="{{ asset('style/marcas/index.css') }}">

</head>

<body>
    <x-header />
    <x-headersama />

    <x-nav />

    <div class="container my-5">
        <h1 class="text-center mb-5" style="font-weight: bold;">Marcas</h1>

        <div class="brand-grid">
            @foreach($marcas as $marca)
            <a href="{{ route('marcas.show', ['marca' => $marca]) }}" class="brand-card-link">
                <div class="brand-card">
                    @php
                    $imagePath = \App\Models\BrandImage::where('marca', $marca)->first();
                    $imageSrc = $imagePath ? asset('storage/' . $imagePath->image_path) : asset('images/marcas/default.png');
                    @endphp

                    <img src="{{ $imageSrc }}" alt="{{ $marca }}" class="brand-logo">
                    <p class="brand-name">{{ $marca }}</p>
                </div>
            </a>
            @endforeach

        </div>


    </div>





    <x-footer />

</body>
<script src="{{ asset('js/desplegable.js') }}"></script>
</html>