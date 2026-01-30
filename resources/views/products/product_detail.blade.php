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

<body>
    <x-header />
    <x-headersama />
    <x-nav />
    @php($shopEnabled = \App\Models\Setting::enabled()) @endphp


    <div class="product-detail-container">
        <div class="product-image">

            @php
            // Intentamos decodificar las imágenes
            $images = [];

            if (!empty($product->img)) {
            // Si es JSON válido, lo decodificamos
            $decoded = json_decode($product->img, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
            $images = $decoded;
            } else {
            // Si no es JSON, asumimos una sola imagen
            $images = [$product->img];
            }
            }

            // Normalizamos las rutas
            $images = array_filter(array_map(function ($image) {
            return str_replace('\\', '/', $image);
            }, $images));
            @endphp

            @if (!empty($images))
            <div class="gallery-container" style="text-align:center;">
                <!-- Imagen principal -->
                <div class="main-image" style="margin-bottom: 15px;">
                    <img src="{{ asset($images[0]) }}" alt="{{ $product->nombre_es }}" id="currentImage" class="img-fluid" style="max-width: 300px; border: 1px solid #ccc; border-radius: 5px;">
                </div>

                <!-- Miniaturas -->
                @if(count($images) > 1)
                <div class="thumbnail-container" style="display: flex; gap: 10px; justify-content: center;">
                    @foreach($images as $image)
                    <img src="{{ asset($image) }}" alt="{{ $product->nombre_es }}" class="thumbnail" onclick="changeImage('{{ asset($image) }}')" style="width: 80px; height: 80px; object-fit: cover; cursor: pointer; border: 2px solid transparent;" onmouseover="this.style.borderColor='#ccc';" onmouseout="this.style.borderColor='transparent';">
                    @endforeach
                </div>
                @endif
            </div>
            @else
            <div class="no-image">
                No hay imagen disponible
            </div>
            @endif
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

            @if ($product->stock == 0)
            <div class="stock">
                <span class="text-red-500">Agotado</span>
            </div>

            @elseif($shopEnabled)

            @if (auth()->check())
            <button class="comprar-btn" data-product-id="{{ $product->id }}">
                <img src="{{ asset('img/carrito-compra.png') }}" alt="carrito de la compra">
                <p>Añadir al carrito</p>
            </button>


            @else
            {{-- MODO CATÁLOGO --}}
            <div class="catalogo-info">
                <span class="catalogo-badge">Modo catálogo</span>
                <p class="catalogo-text">
                    Actualmente la página está en modo catálogo.
                    <br>
                    <strong>Contacta con nosotros</strong> para más información o presupuesto.
                </p>
            </div>
            @endif
            
            @else
            <div id="sesion">
                <p class="login"><b>Por favor, inicie sesión para comprar.</b></p>
                <a href="{{ route('login') }}">Iniciar sesión</a>
            </div>
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