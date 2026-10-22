<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('img/logos sama/logosama.jpg') }}">
    <title>{{ $product->nombre_es }} | {{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('/style/products/details.css') }}">

</head>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('[data-product-gallery]').forEach(function(gallery) {
            const mainImage = gallery.querySelector('[data-gallery-main-image]');
            const thumbnails = Array.from(
                gallery.querySelectorAll('[data-gallery-index]')
            );

            if (!mainImage || thumbnails.length < 2) return;

            let currentIndex = 0;

            function showImage(index) {
                currentIndex = (index + thumbnails.length) % thumbnails.length;

                const selected = thumbnails[currentIndex];

                mainImage.src = selected.dataset.imageSrc;
                mainImage.alt = selected.getAttribute('aria-label') || 'Imagen del producto';

                thumbnails.forEach(function(thumb, i) {
                    const active = i === currentIndex;

                    thumb.classList.toggle('is-active', active);
                    thumb.setAttribute('aria-pressed', active ? 'true' : 'false');
                });
            }

            thumbnails.forEach(function(thumb, index) {
                thumb.addEventListener('click', function() {
                    showImage(index);
                });
            });

            const previous = gallery.querySelector('[data-gallery-prev]');
            const next = gallery.querySelector('[data-gallery-next]');

            if (previous) {
                previous.addEventListener('click', function() {
                    showImage(currentIndex - 1);
                });
            }

            if (next) {
                next.addEventListener('click', function() {
                    showImage(currentIndex + 1);
                });
            }
        });
    });
</script>


<body>
    <x-header />
    <x-headersama />
    <x-nav />
    @php($shopEnabled = \App\Models\Setting::enabled()) @endphp


    <div class="product-detail-container">
        <div class="product-image">

            @php
            // Obtener el valor original guardado en la base de datos
            $rawImages = $product->getRawOriginal('img');

            // Intentar interpretar el JSON
            $productImages = json_decode($rawImages, true);

            // Compatibilidad si el JSON contiene otro JSON codificado
            if (is_string($productImages)) {
            $decodedAgain = json_decode($productImages, true);

            if (is_array($decodedAgain)) {
            $productImages = $decodedAgain;
            } else {
            // Producto antiguo con una sola imagen
            $productImages = trim($productImages) !== ''
            ? [$productImages]
            : [];
            }
            }

            // Compatibilidad con rutas antiguas que no están en JSON
            if (!is_array($productImages)) {
            $productImages = is_string($rawImages) && trim($rawImages) !== ''
            ? [$rawImages]
            : [];
            }

            // Quitar valores vacíos y reindexar la lista
            $productImages = array_values(array_filter(
            $productImages,
            fn ($image) => is_string($image) && trim($image) !== ''
            ));
            @endphp
            <div class="product-gallery" data-product-gallery>

                @if(count($productImages) > 0)

                {{-- Imagen principal --}}
                <div class="product-gallery-main">

                    <img src="{{ asset($productImages[0]) }}" alt="{{ $product->nombre_es }}" class="product-gallery-main-image" data-gallery-main-image>

                    @if(count($productImages) > 1)
                    <button type="button" class="product-gallery-arrow product-gallery-prev" data-gallery-prev aria-label="Imagen anterior">
                        &#10094;
                    </button>

                    <button type="button" class="product-gallery-arrow product-gallery-next" data-gallery-next aria-label="Imagen siguiente">
                        &#10095;
                    </button>
                    @endif

                </div>

                {{-- Miniaturas de todas las imágenes --}}
                @if(count($productImages) > 1)

                <div class="product-gallery-thumbnails">

                    @foreach($productImages as $index => $image)

                    <button type="button" class="product-gallery-thumb {{ $loop->first ? 'is-active' : '' }}" data-gallery-index="{{ $index }}" data-image-src="{{ asset($image) }}" aria-label="Ver imagen {{ $index + 1 }}" aria-pressed="{{ $loop->first ? 'true' : 'false' }}">
                        <img src="{{ asset($image) }}" alt="Miniatura {{ $index + 1 }}" loading="lazy">
                    </button>

                    @endforeach

                </div>

                @endif

                @else

                <div class="product-gallery-empty">
                    No hay imágenes disponibles para este producto.
                </div>

                @endif

            </div>
        </div>

        <div class="product-info">
            <h1 class="product-title">{{ $product->nombre_es }}</h1>
            <div class="marca-ref">
                <p class="ref"><b>Referencia:</b> {{$product->referencia}}</p>
            </div><br>
            @if ($product->proveedor_logo_path)
            <div class="proveedor-logo">
                <img src="{{ asset($product->proveedor_logo_path) }}" alt="Logo del Proveedor" class="img-fluid" style="max-width: 150px; max-height: 150px;">
            </div><br>
            @endif
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



            {{-- USUARIO NO LOGUEADO --}}
            @guest
            <div class="catalogo-info">
                <span class="catalogo-badge">
                    {{ $shopEnabled ? 'Acceso requerido' : 'Modo catálogo' }}
                </span>

                <p class="catalogo-text">
                    @if($shopEnabled)
                    Inicia sesión para ver precios y comprar este producto.
                    @else
                    Este producto no está disponible para compra online.
                    @endif
                </p>

                <a href="{{ route('login') }}" class="login-btn">
                    Iniciar sesión
                </a>
            </div>

            {{-- USUARIO LOGUEADO --}}
            @else
            {{-- STOCK --}}
            @if ($product->stock == 0)
            <div class="stock">
                <span class="text-red-500">Agotado</span>
            </div>

            @else
            {{-- TIENDA ACTIVA --}}
            @if ($shopEnabled)
            <button class="comprar-btn" data-product-id="{{ $product->id }}">
                <p>Añadir al carrito</p>
            </button>

            {{-- MODO CATÁLOGO --}}
            @else
            <div class="catalogo-info">
                <span class="catalogo-badge">Modo catálogo</span>
                <p class="catalogo-text">
                    Este producto no está disponible para compra online.
                    <br>
                    <strong>Contacta con nosotros</strong> para más información.
                </p>
            </div>
            @endif

            @endguest

            @endif



            @if ($product->pdf)
            <div class="product-pdf">
                <a href="{{ asset('storage/' . $product->pdf) }}" target="_blank">Ficha Técnica</a>
            </div>
            @endif

            <div class="descripcion">
                <h3>Descripción</h3>
                <p>{{ $product->descripcion }}</p>
            </div>
        </div>
    </div>

    <div class="info">
        <ul class="tabs">
            <li class="tab active" onclick="openTab('caracteristicas')">Detalles</li>
            <li class="tab" onclick="openTab('comentarios')">Comentarios</li>
        </ul>

        @php
        // Verifica si $product->detalles_lista es un string, y si es así, decodifícalo.
        if (is_string($product->detalles_lista)) {
        $detalles = json_decode($product->detalles_lista, true) ?? [];
        } else {
        // Si ya es un array, úsalo directamente.
        $detalles = $product->detalles_lista ?? [];
        }
        @endphp

        <div class="caracteristicas">
            <div id="caracteristicas" class="tab-content active">
                @if (!empty($detalles))
                <ul>
                    @foreach ($detalles as $detalle)
                    <li>{{ $detalle }}</li>
                    @endforeach
                </ul>
                @else
                <p>No hay detalles disponibles.</p>
                @endif
            </div>
        </div>
        <div class="comentarios">
            <div id="comentarios" class="tab-content">
                <h4>Dejanos tu comentario!</h4><br>
                <form action="{{ route('comentario.store', ['id' => $product->id]) }}" method="post" id="form-comentarios">
                    @csrf

                    <textarea name="contenido" rows="3" placeholder="Dejanos tu opinion sobre el producto"></textarea>
                    <div class="publicar">
                        <button type="submit">Publicar Comentario</button>
                    </div>
                </form><br>

                <h2>Comentarios</h2>
                @foreach ($comentarios as $comentario)
                <div class="comentario">
                    <strong>{{ $comentario->usuario->name }} {{ $comentario->usuario->surname }}</strong>
                    <p>{{ $comentario->contenido }}</p>
                    <p class="comment-date">{{ $comentario->formatted_date }}</p>
                    @if(auth()->user()->id === $comentario->usuario->id)
                    <button class="edit-comment-btn" data-comment-id="{{ $comentario->id }}">Editar</button>
                    <form id="edit-comment-form-{{ $comentario->id }}" class="edit-comment-form" action="{{ route('comentario.update', ['id' => $comentario->id]) }}" method="post">
                        @csrf
                        @method('PUT')
                        <textarea name="contenido" rows="3">{{ $comentario->contenido }}</textarea>
                        <div class="actualizar">
                            <button type="submit">Actualizar Comentario</button>
                        </div>
                    </form>
                    @endif
                </div><br>
                @endforeach
            </div>
        </div>
    </div>



    <x-footer />

</body>

</html>
<script>
    const csrfToken = '{{ csrf_token() }}';
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script src="{{ asset('js/carrito.js') }}"></script>
<script src="{{ asset('js/texto.js') }}"></script>
<script src="{{ asset('js/comentarios.js') }}"></script>
<script src="{{ asset('js/desplegable.js') }}"></script>
<script src="{{ asset('js/imagenes.js') }}"></script>
<script>
    $(document).ready(function() {
        // Ocultar los formularios de edición al cargar la página
        $(".edit-comment-form").hide();

        // Mostrar el formulario de edición al hacer clic en el botón "Editar"
        $(".edit-comment-btn").on("click", function() {
            var commentId = $(this).data("comment-id");
            $(".edit-comment-form").hide(); // Ocultar otros formularios de edición
            $("#edit-comment-form-" + commentId).show(); // Mostrar el formulario de edición específico
        });
    });
</script>
