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
    <link rel="stylesheet" href="{{ asset('style/marcas/show.css') }}">

</head>

<body>
    <x-header />
    <x-headersama />

    <x-nav />

    <h2>Productos de {{ $marca }}</h2>
    <br>
    <div class="productos">
        <div class="productos-list">
            @foreach ($products as $product)
            <div class="product">
                <a href="{{ route('products.showDetail', ['id' => $product->id]) }}">
                    <div class="image-container">
                        @php
                        // Decodificamos las imágenes del producto si es JSON
                        $images = json_decode($product->img, true);

                        // Si la imagen no es JSON, asumimos que es un producto antiguo con una imagen única
                        if (json_last_error() !== JSON_ERROR_NONE) {
                        $images = [$product->img];
                        }
                        @endphp

                        @if (!empty($images) && is_array($images))
                        <!-- Mostramos la primera imagen, ya sea de un producto nuevo o antiguo -->
                        <img src="{{ asset($images[0]) }}" alt="{{ $product->nombre_es }}">
                        @else
                        <div class="no-image">
                            No hay imagen disponible
                        </div>
                        @endif
                    </div>
                    <div class="product-info">
                        <div class="product-title">
                            <h2>{{ $product->nombre_es }}</h2>
                        </div>
                        @if (auth()->check() && auth()->user()->role)
                        @if (auth()->user()->role->role === 'profesional')
                        <div class="product-price">
                            <p>{{ $product->precio_oferta_es }}€</p>
                        </div>
                        @else
                        <div class="product-price">
                            <p>{{ $product->precio_es }}€</p>
                        </div>
                        @endif
                        @endif
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        <div class="pagination">
            {{ $products->appends(request()->query())->links() }}
        </div>
    </div>



    <x-footer />

</body>
<script src="{{ asset('js/desplegable.js') }}"></script>

</html>