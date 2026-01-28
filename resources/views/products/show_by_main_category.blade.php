<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('img/logos sama/logosama.jpg') }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('/style/products/pagination.css') }}">

</head>

<body>

    <x-header />
    <x-headersama />
    <x-nav />

    @php($shopEnabled = \App\Models\Setting::enabled()) @endphp

    <h2>PRODUCTOS</h2><br>

    <div class="container">
        <div class="productos-y-categorias">
            <div class="categorias">
                <h3>Categorías</h3>
                <ul class="categorias-list">
                    @foreach ($categories as $category)
                    <li>
                        <a href="{{ route('products.showProductsByCategory', ['categorySlug' => $category->slug]) }}">
                            {{ $category->nombre }}
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
                                    @if($shopEnabled)
                                    <span class="price">{{ $product->precio_oferta_es }} €</span>
                                    @endif
                                </div>
                                @else
                                <div class="product-price">
                                    @if($shopEnabled)
                                    <span class="price">{{ $product->precio_es }} €</span>
                                    @endif
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

    <script>
        // Filtrar productos por categoría al hacer clic en un botón
        const botonesFiltro = document.querySelectorAll('.filtro-categoria');

        botonesFiltro.forEach(boton => {
            boton.addEventListener('click', () => {
                const categoriaSeleccionada = boton.dataset.categoria;
                filtrarProductosPorCategoria(categoriaSeleccionada);
            });
        });

        function filtrarProductosPorCategoria(categoria) {
            const productos = document.querySelectorAll('.product');

            productos.forEach(producto => {
                const categoriasProducto = JSON.parse(producto.getAttribute('data-categories'));
                if (categoriasProducto.includes(categoria)) {
                    producto.style.display = 'block';
                } else {
                    producto.style.display = 'none';
                }
            });
        }
    </script>

</body>

</html>