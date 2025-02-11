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
    <link rel="stylesheet" href="{{ asset('style/index.css') }}">

</head>

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



    @if (auth()->check() && auth()->user()->role && auth()->user()->role->role === 'admin')
    <button id="edit-mode-button" style="display: block;">Modo Edición</button>
    @endif

    <div id="proveedores">
        <div id="imagenes">
            @foreach ($proveedores as $proveedor)
            <div class="proveedor-item" data-path="{{ $proveedor->path }}">
                <img src="{{ asset($proveedor->path) }}" alt="Logo del proveedor" width="120px" height="50px">

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


    <x-footer />
    <script src="{{ asset('js/desplegable.js') }}"></script>
    <script src="{{ asset('js/footer.js') }}"></script>
    <script src="{{ asset('js/edit-proveedores.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js"></script>
    <script src="{{ asset('js/sortable.js') }}"></script>
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
    </script>

</body>

</html>