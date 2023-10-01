<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('/style/products/pagination.css') }}">

</head>

<body>

    <x-header />
    <x-headersama />
    <x-nav />

    <h2>PRODUCTOS</h2><br>

    <div class="productos-list">
        @foreach ($products as $product)
        <div class="product">
            <a href="{{ route('products.showDetail', ['id' => $product->id]) }}">
                <div class="image-container">
                    @if ($product->img)
                    <img src="{{ asset($product->img) }}" alt="{{ $product->nombre_es }}">
                    @else
                    <div class="no-image">
                        No hay imagen disponible
                    </div>
                    @endif
                </div>
                <div class="product-info">
                    <h2>{{ $product->nombre_es }}</h2><br>
                    <p>Precio: {{ $product->precio_es }}€</p>
                </div>
            </a>
        </div>
        @endforeach
    </div>


    <div class="pagination">
        {{ $products->appends(request()->query())->links() }}
    </div>


    <x-footer />

</body>

</html>