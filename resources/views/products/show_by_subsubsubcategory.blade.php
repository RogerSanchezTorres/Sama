<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('img/logos sama/logosama.jpg') }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="{{ asset('/style/products/category.css') }}">
</head>

<body>
    <x-header />
    <x-headersama />
    <x-nav />

    <h2>{{ $subsubsubcategory->nombre }}</h2><br>

    <div class="container">
        <div class="productos-y-categorias">
            <div class="categorias">
                <h3>Categorías</h3>
                <ul class="categorias-list">
                    @foreach ($relatedCategories as $relatedCategory)
                    <li>
                        <a href="{{ route('products.showProductsByCategory', ['categorySlug' => $relatedCategory->slug]) }}">
                            {{ $relatedCategory->nombre }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="productos">
            <div class="productos-list">
                @foreach ($products as $product)
                <div class="product">
                    <a href="{{ route('products.showDetail', ['id' => $product->id]) }}">
                        @php
                        $images = json_decode($product->img, true);
                        if (json_last_error() !== JSON_ERROR_NONE) {
                        $images = [$product->img];
                        }
                        @endphp

                        @if (!empty($images))
                        <img src="{{ asset($images[0]) }}" alt="{{ $product->nombre_es }}">
                        @else
                        <div class="no-image">No hay imagen disponible</div>
                        @endif

                        <div class="product-info">
                            <h2>{{ $product->nombre_es }}</h2>
                            @if (auth()->check() && auth()->user()->role)
                            @if (auth()->user()->role->role === 'profesional')
                            <p>{{ $product->precio_oferta_es }}€</p>
                            @else
                            <p>{{ $product->precio_es }}€</p>
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
    </div>

    <x-footer />
    <script src="{{ asset('js/desplegable.js') }}"></script>
</body>

</html>