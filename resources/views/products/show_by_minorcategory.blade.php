<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('img/logos sama/logosama.jpg') }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('/style/products/category.css') }}">
</head>

<body>
    <x-header />
    <x-headersama />
    <x-nav />

    <h2>{{ $minorCategory->nombre }}</h2><br>

    <div class="container">
        <div class="productos-y-categorias">
            <div class="categorias">
                <h3>Categorías</h3>
                <ul class="categorias-list">
                    @foreach ($relatedCategories as $relatedCategory)
                    <li>
                        <a href="{{ route('products.showProductsByCategory', ['categorySlug' => $relatedCategory->slug]) }}"
                            @if ($subcategory->category->id === $relatedCategory->id) class="selected" @endif>
                            {{ $relatedCategory->nombre }}
                        </a>
                        @if ($subcategory->category->id === $relatedCategory->id)
                        @if ($relatedCategory->subcategories->count() > 0)
                        <ul class="subcategorias-list">
                            @foreach ($relatedCategory->subcategories as $subcat)
                            <li>
                                <a href="{{ route('products.showProductsBySubcategory', ['subcategorySlug' => $subcat->slug]) }}"
                                    @if ($subcategory->id === $subcat->id) class="selected" @endif>
                                    {{ $subcat->nombre }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                        @endif
                        @endif
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
    </div>

    <x-footer />
    <script src="{{ asset('js/desplegable.js') }}"></script>
</body>

</html>