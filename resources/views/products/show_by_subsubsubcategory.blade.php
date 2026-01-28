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
    @php($shopEnabled = \App\Models\Setting::enabled()) @endphp


    <h2>{{ $subsubsubcategory->nombre }}</h2><br>

    <div class="container">
        <div class="productos-y-categorias">
            <div class="categorias">
                <h3>Categorías</h3>

                <ul class="categorias-list">

                    @foreach ($relatedCategories as $relatedCategory)
                    <li>
                        <a href="{{ route('products.showProductsByCategory', ['categorySlug' => $relatedCategory->slug]) }}"
                            @if ($subsubsubcategory->subsubcategory->subcategory->category->id === $relatedCategory->id) class="selected" @endif>
                            {{ $relatedCategory->nombre }}
                        </a>
                        @if ($subsubsubcategory->subsubcategory->subcategory->category->id === $relatedCategory->id)
                        @if ($relatedCategory->subcategories->count() > 0)
                        <ul class="subcategorias-list">
                            @foreach ($relatedCategory->subcategories as $subcat)
                            <li>
                                <a href="{{ route('products.showProductsBySubcategory', ['subcategorySlug' => $subcat->slug]) }}"
                                    @if ($subsubsubcategory->subsubcategory->subcategory->id === $subcat->id) class="selected" @endif>
                                    {{ $subcat->nombre }}
                                </a>
                                @if ($subsubsubcategory->subsubcategory->subcategory->id === $subcat->id)
                                <ul class="subsubcategorias-list">
                                    @foreach ($subcat->subsubcategories as $subsubcat)
                                    <li>
                                        <a href="{{ route('products.showProductsBySubsubcategory', ['subsubcategorySlug' => $subsubcat->slug]) }}"
                                            @if ($subsubsubcategory->subsubcategory->id === $subsubcat->id) class="selected" @endif>
                                            {{ $subsubcat->nombre }}
                                        </a>
                                        @if ($subsubsubcategory->subsubcategory->id === $subsubcat->id)
                                        <ul class="subsubsubcategorias-list">
                                            @foreach ($subsubcat->subsubsubcategories as $subsubsubcat)
                                            <li>
                                                <a href="{{ route('products.showProductsBySubsubsubcategory', ['subsubsubcategorySlug' => $subsubsubcat->slug]) }}"
                                                    @if ($subsubsubcategory->id === $subsubsubcat->id) class="selected" @endif>
                                                    {{ $subsubsubcat->nombre }}
                                                </a>
                                                @if ($subsubsubcategory->id === $subsubsubcat->id)
                                                <ul class="subsubsubsubcategorias-list">
                                                    @foreach ($subsubsubcat->subsubsubsubcategories as $subsubsubsubcat)
                                                    <li>
                                                        <a href="{{ route('products.showProductsBySubsubsubsubcategory', ['slug' => $subsubsubsubcat->slug]) }}">
                                                            {{ $subsubsubsubcat->nombre }}
                                                        </a>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                                @endif
                                            </li>
                                            @endforeach
                                        </ul>
                                        @endif
                                    </li>
                                    @endforeach
                                </ul>
                                @endif
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
                            @if($shopEnabled)
                            <span class="price">{{ $product->precio_oferta_es }} €</span>
                            @endif
                            @else
                            @if($shopEnabled)
                            <span class="price">{{ $product->precio_es }} €</span>
                            @endif
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