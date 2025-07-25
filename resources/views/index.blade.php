<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{ asset('img/logos sama/logosama.jpg') }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    <link rel="stylesheet" href="{{ asset('style/index.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

</head>
<script>
    function toggleMedia(id) {
        const image = document.getElementById('image-' + id);
        const video = document.getElementById('video-' + id);

        if (image && video) {
            const showingImage = image.style.display !== 'none';
            image.style.display = showingImage ? 'none' : 'block';
            video.style.display = showingImage ? 'block' : 'none';
        }
    }
</script>

<body>
    <x-header />
    <x-headersama />

    <x-nav />

    @if (auth()->check() && auth()->user()->role && auth()->user()->role->role === 'admin')
    <button id="edit-button">Modo Edición</button>
    @endif


    <div id="image-list" class="img-info">
        <!-- Las imágenes desde la base de datos -->
        @foreach($images as $image)
        <div class="image-item" data-id="{{ $image->id }}">
            <div class="border"></div>
            <img src="{{ asset($image->path) }}" alt="Imagen" class="image" style=" max-width: 383px; height: 215px; margin: 10px;">
            <form action="{{ route('images.destroy', $image->id) }}" method="POST" class="delete-form" style="display:none;">
                @csrf
                @method('DELETE')
                <button type="submit" class="delete-button">Eliminar</button>
            </form>
        </div>
        @endforeach
    </div>


    <!-- Formulario para añadir imágenes -->
    <div id="add-image-form" style="display:none;">
        <h3>Añadir Nueva Imagen</h3>
        <input type="file" id="new-image-file" accept="image/*">
        <button id="add-image-button">Añadir Imagen</button>
    </div>

    <!-- NOTICICAS -->
    @if($news->count() || (auth()->check() && auth()->user()->role_id == 1))
    <div class="news-section">
        @auth
        @if(auth()->user()->role_id == 1)
        <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data" id="store">
            @csrf
            <input type="text" name="title" placeholder="Título" required>
            <textarea name="content" placeholder="Descripción" required></textarea>
            <input type="file" name="image" accept="image/*">
            <input type="url" name="link" placeholder="Enlace al producto (opcional)">
            <input type="file" name="video" accept="video/*">
            <button type="submit" id="publicar">Publicar Noticia</button>
        </form>
        @endif
        @endauth

        @if($news->count())
        <div id="news-list">
            @foreach($news as $item)
            <div class="news-item" data-id="{{ $item->id }}" style="position: relative;">

                {{-- Contenedor multimedia con flechas --}}
                <div class="media-toggle" style="position: relative; display: flex; justify-content: center; align-items: center;">

                    {{-- Imagen --}}
                    @if($item->image)
                    <img id="image-{{ $item->id }}" src="{{ asset('storage/' . $item->image) }}" alt="Imagen Noticia"
                        style="max-width: 100%; display: {{ $item->video ? 'none' : 'block' }};">
                    @endif

                    {{-- Video --}}
                    @if($item->video)
                    <video id="video-{{ $item->id }}" width="100%" height="auto" controls
                        style="margin-top: 10px; {{ $item->image ? 'display:none;' : '' }}">
                        <source src="{{ asset('storage/' . $item->video) }}" type="video/mp4">
                        Tu navegador no soporta la reproducción de videos.
                    </video>
                    @endif

                    {{-- Flechas de navegación (solo si hay ambos) --}}
                    @if($item->image && $item->video)
                    <button onclick="toggleMedia('{{ $item->id }}')"
                        style="position: absolute; top: -30px; right: -10px; border: none; background:white; border-radius: 50%; width: 30px; height: 30px; cursor: pointer; color:black;">
                        ⇄
                    </button>
                    @endif
                </div>

                <h3>{{ $item->title }}</h3>
                <p>{{ $item->content }}</p>

                @if($item->link)
                <a href="{{ $item->link }}" target="_blank">Leer más</a>
                @endif

                @auth
                @if(auth()->user()->role_id == 1)
                <form action="{{ route('news.destroy', $item->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Eliminar</button>
                </form>
                @endif
                @endauth
            </div>
            @endforeach
        </div>
        @endif

    </div>
    @endif


    <!-- IMAGENES PROVEEDORES -->
    @if (auth()->check() && auth()->user()->role && auth()->user()->role->role === 'admin')
    <button id="edit-mode-button" style="display: block;">Modo Edición</button>
    @endif

    <div id="proveedores">
        <div id="imagenes">
            @foreach ($proveedores as $proveedor)
            <a href="{{ route('proveedores.index') }}" class="proveedor-link">
                <div class="proveedor-item" data-path="{{ $proveedor->path }}">
                    <img src="{{ asset($proveedor->path) }}" alt="Logo del proveedor" width="120px" height="50px">
            </a>
            <form action="{{ route('proveedores.deleteProveedor', $proveedor->id) }}" method="POST" class="delete-form" style="display:none;">
                @csrf
                @method('DELETE')
                <button type="submit" class="delete-button">Eliminar</button>
            </form>
        </div>

        @endforeach
    </div>
    </div>

    <div id="add-proveedor-form" style="display:none;">
        <h4>Añadir Nueva Imagen de Proveedor</h4>
        <input type="file" id="new-proveedor-image" name="file" accept="image/*">
        <button id="add-proveedor-button">Añadir Imagen</button>
    </div>


    <!-- PRODUCTOS DESTACADOS -->
    @if(auth()->check() && auth()->user()->role_id == 1)
    <h4>Añadir Producto Destacado</h4>
    <form action="{{ route('featured-products.store') }}" method="POST">
        @csrf
        <select name="product_id" id="product-select" class="form-control" required>
            @foreach($allProducts as $producto)
            <option value="{{ $producto->id }}">{{ $producto->nombre_es }}</option>
            @endforeach
        </select>


        <select name="apartado_id" required>
            @foreach($apartados as $apartado)
            <option value="{{ $apartado->id }}">{{ $apartado->nombre }}</option>
            @endforeach
        </select>

        <button type="submit">Añadir</button>
    </form>

    @endif



    @if($destacados->count())
    @foreach($apartados as $apartado)
    @php
    $productos = $destacados->where('apartado_id', $apartado->id);
    @endphp


    @if($productos->count())
    <h3>{{ $apartado->nombre }}</h3>
    <div class="productos-destacados">
        @foreach($productos as $item)
        @if($item->product)
        <div class="producto-card">
            <a href="{{ route('products.showDetail', $item->product->id) }}" class="producto-card-link">
                @if($item->product->img)
                <div class="imagen-producto">
                    <img src="{{ $item->product->img ?? '/images/default.png' }}" alt="{{ $item->product->nombre_es }}">
                </div>
                @endif

                <h4>{{ $item->product->nombre_es }}</h4>
            </a>

            @if(auth()->check() && auth()->user()->role_id == 1)
            <form action="{{ route('featured-products.destroy', $item->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">Eliminar</button>
            </form>
            @endif
        </div>
        @endif
        @endforeach
    </div>
    @endif
    @endforeach
    @endif




    <x-footer />
    <script src="{{ asset('js/desplegable.js') }}"></script>
    <script src="{{ asset('js/footer.js') }}"></script>
    <script src="{{ asset('js/edit-proveedores.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js"></script>
    <script src="{{ asset('js/sortable.js') }}"></script>
    <script src="{{ asset('js/buscador.js') }}"></script>
    <script>
        const updateOrderUrl = "{{ route('images.updateOrder') }}";
    </script>
    <script>
        const uploadProveedorUrl = "{{ route('proveedores.upload') }}";
    </script>

    <script>
        const csrfToken = "{{ csrf_token() }}";

        document.getElementById('edit-button').addEventListener('click', function() {
            document.querySelectorAll('.delete-form').forEach(form => {
                form.style.display = form.style.display === 'none' ? 'block' : 'none';
            });
            document.getElementById('add-image-form').style.display =
                document.getElementById('add-image-form').style.display === 'none' ? 'block' : 'none';
        });

        document.getElementById("add-image-button").addEventListener("click", function() {
            let fileInput = document.getElementById("new-image-file");
            let file = fileInput.files[0];

            if (file) {
                const formData = new FormData();
                formData.append('image', file);

                fetch('{{ route("images.upload") }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            const newDiv = document.createElement('div');
                            newDiv.className = 'image-item';
                            newDiv.setAttribute('data-id', data.id);

                            newDiv.innerHTML = `
                        <img src="${data.url}" alt="Nueva Imagen" style="max-width: 383px; height: 215px; margin: 10px; border-top: 1px solid #ffc106;">
                        <form action="/images/${data.id}" method="POST" class="delete-form" style="display:none;">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="delete-button">Eliminar</button>
                        </form>
                    `;
                            document.querySelector('.img-info').appendChild(newDiv);
                            fileInput.value = '';
                        } else {
                            alert(data.message || 'Error al subir la imagen');
                        }
                    })
                    .catch(error => console.error('Error:', error));
            } else {
                alert('Por favor, selecciona una imagen.');
            }
        });

        document.querySelector("#image-list").addEventListener('click', function(event) {
            if (event.target.classList.contains('delete-button')) {
                event.preventDefault();

                const deleteButton = event.target;
                const form = deleteButton.closest('.delete-form');
                const imageItem = deleteButton.closest('.image-item'); // Solo busca en imágenes normales
                const action = form.getAttribute('action');

                fetch(action, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            imageItem.remove();
                        } else {
                            alert(data.message || 'Error al eliminar la imagen.');
                        }
                    })
                    .catch(error => console.error('Error:', error));
            }
        });

        const container = document.getElementById('news-list');
        if (container) {
            Sortable.create(container, {
                animation: 150,
                handle: null,
                onEnd: function(evt) {
                    const orden = [];
                    document.querySelectorAll('.news-item').forEach((item, index) => {
                        orden.push({
                            id: item.getAttribute('data-id'),
                            position: index + 1
                        });
                    });

                    fetch("{{ route('news.sort') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({
                            orden: orden
                        })
                    });
                }
            });
        }
    </script>

</body>

</html>