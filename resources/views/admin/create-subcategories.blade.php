<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('img/logos sama/logosama.jpg') }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('/style/admin/subcategories.css') }}">
</head>

<body>

    <x-header />
    <x-headersama />
    <x-nav />
    <x-header-admin />

    <h2>Añadir Subcategoria</h2>

    <form action="{{ route('admin.store-subcategories') }}" method="post" class="form">
        @csrf

        <div>
            <label for="nombre">Nombre de la subcategoría:</label>
            <input type="text" name="nombre" id="nombre" required>
        </div>
        <div>
            <label for="slug">Slug: (Repetir nombre)</label>
            <input type="text" name="slug" id="slug" required>
        </div>

        <div>
            <label for="main_category_id">Categoría principal:</label>
            <select name="main_category_id" id="main_category_id" required>
                <option value="">Selecciona una categoría principal</option>
                @foreach ($mainCategories as $mainCategory)
                <option value="{{ $mainCategory->id }}">{{ $mainCategory->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="category_id" class="form-label">Subcategoría:</label>
            <select name="category_id" id="category_id"required>
                <option value="">Selecciona una subcategoría</option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->nombre }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Crear Subcategoría</button>
    </form>



    <x-footer />
    <script src="{{ asset('js/desplegable.js') }}"></script>
    <script>
        document.getElementById('main_category_id').addEventListener('change', function() {
            var mainCategoryId = this.value;
            var categorySelect = document.getElementById('category_id');

            // Realiza una solicitud AJAX para obtener las subcategorías filtradas
            fetch('/admin/subcategories/' + mainCategoryId)
                .then(response => response.json())
                .then(data => {
                    // Elimina todas las opciones actuales de la lista desplegable de subcategorías
                    categorySelect.innerHTML = '';

                    // Agrega una opción por defecto
                    var defaultOption = document.createElement('option');
                    defaultOption.value = '';
                    defaultOption.textContent = 'Selecciona una subcategoría';
                    categorySelect.appendChild(defaultOption);

                    // Agrega las nuevas opciones de subcategorías a la lista desplegable
                    data.forEach(subcategory => {
                        var option = document.createElement('option');
                        option.value = subcategory.id;
                        option.textContent = subcategory.nombre;
                        categorySelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Error al obtener las subcategorías: ', error));
        });
    </script>



</body>

</html>