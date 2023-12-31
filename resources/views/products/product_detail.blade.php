<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('/style/products/details.css') }}">

</head>

<body>

    <x-header />
    <x-headersama />
    <x-nav />

    <div class="product-detail-container">
        <div class="product-image">
            @if ($product->img)
            <img src="{{ asset($product->img) }}" alt="{{ $product->nombre_es }}">
            @else
            <div class="no-image">
                No hay imagen disponible
            </div>
            @endif
        </div>
        <div class="product-info">
            <h1 class="product-title">{{ $product->nombre_es }}</h1><br>
            <p class="product-price">Precio: {{ $product->precio_es }}€</p>
            @if (auth()->check())
            <button class="comprar-btn" data-product-id="{{ $product->id }}"><img src="{{ asset('img/carrito-compra.png') }}" alt="carrito de la compra" id="carrito-compra">
                <p>Añadir al carrito</p>
            </button>
            @else
            <div id="sesion">
                <p class="login"><b>Por favor, inicie sesión para comprar.</b></p>
                <a href="{{ route('login') }}">Iniciar sesión</a>
            </div>
            @endif
            <div class="descripcion">
                <h3>Descripción</h3>
                <p>{{ $product->descripcion }}</p>
            </div>
        </div>
    </div>


    <form action="{{ route('comentario.store', ['id' => $product->id]) }}" method="post" id="comentarios">
        @csrf
        <textarea name="contenido" rows="3" placeholder="Dejanos tu opinion sobre el producto"></textarea>
        <div class="publicar">
            <button type="submit">Publicar Comentario</button>
        </div>
    </form><br>


    @foreach ($comentarios as $comentario)
    <h2>Comentarios</h2>
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
    </div>
    @endforeach


    <x-footer />

</body>

</html>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script src="{{ asset('js/carrito.js') }}"></script>
<script src="{{ asset('js/texto.js') }}"></script>
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