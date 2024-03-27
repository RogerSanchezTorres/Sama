<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('img/logos sama/logosama.jpg') }}">
    <title>{{ $category->nombre }} | {{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('/style/products/category.css') }}">

</head>

<body>

    <x-header />
    <x-headersama />
    <x-nav />

    <h2>{{ $category->nombre }}</h2><br>

    <div class="container">
        <div class="productos-y-categorias">
            <div class="categorias">
                <h3>Categorías</h3>
                <ul class="categorias-list">
                    @foreach ($relatedCategories as $relatedCategory)
                    <li>
                        <a href="{{ route('products.showProductsByCategory', ['categorySlug' => $relatedCategory->slug]) }}" @if ($category->id === $relatedCategory->id) class="selected" @endif>
                            {{ $relatedCategory->nombre }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>

            <div class="productos">
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
        </div>
    </div>



    <x-footer />
    <script src="{{ asset('js/desplegable.js') }}"></script>

</body>

</html>