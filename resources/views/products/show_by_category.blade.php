<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('/style/products/category.css') }}">

</head>

<body>

    <x-header />
    <x-headersama />
    <x-nav />

    <h2>PRODUCTOS de la categoría: {{ $category->nombre }}</h2><br>

    <div class="categorias-list">
        <ul>
            @foreach ($filteredCategories as $filteredCategory)
            <li>
                <a href="{{ route('products.showProductsByCategory', ['categorySlug' => $filteredCategory->slug]) }}" @if ($category->slug === $filteredCategory->slug) class="selected" @endif>
                    {{ $filteredCategory->nombre }}
                </a>
            </li>
            @endforeach
        </ul>
    </div>

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
                    <div class="product-title">
                        <h2>{{ $product->nombre_es }}</h2><br>
                    </div>
                    <div class="product-price">
                        <p>Precio: {{ $product->precio_es }}€</p>
                    </div>

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