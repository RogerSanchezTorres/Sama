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
                                @if(auth()->check())
                                @if (auth()->user()->role && auth()->user()->role->role === 'admin')
                                <div class="product-price">
                                    <p>{{ $product->precio_oferta_es }}€</p>
                                </div>
                                @else
                                @endif
                                <div class="product-price">
                                    <p>{{ $product->precio_es }}€</p>
                                </div>

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
                    producto.style.display = 'block'; // Mostrar el producto si pertenece a la categoría seleccionada
                } else {
                    producto.style.display = 'none'; // Ocultar el producto si no pertenece a la categoría seleccionada
                }
            });
        }
    </script>

</body>

</html>