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
    <div class="form-category">
        <form action="{{ route('admin.store-subcategories') }}" method="post" class="form">
            @csrf

            <div class="form-group">
                <label for="nombre">Nombre de la subcategoría:</label>
                <input type="text" name="nombre" id="nombre" required>
            </div>

            <div class="form-group">
                <label for="slug">Slug: (Repetir nombre)</label>
                <input type="text" name="slug" id="slug" required>
            </div>

            <div class="form-group">
                <label for="main_category_id">Categoría principal:</label>
                <select name="main_category_id" id="main_category_id" required>
                    <option value="">Selecciona una categoría principal</option>
                    @foreach ($mainCategories as $mainCategory)
                    <option value="{{ $mainCategory->id }}">{{ $mainCategory->nombre }}</option>
                    @endforeach
                </select>
            </div><br>

            <div class="form-group">
                <label for="category_id" class="form-label">Subcategoría:</label>
                <select name="category_id" id="category_id" required>
                    <option value="">Selecciona una subcategoría</option>
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}" data-main-category-id="{{ $category->main_category_id }}">{{ $category->nombre }}</option>
                    @endforeach
                </select>
            </div><br>

            <div class="crear">
                <button type="submit" class="btn btn-primary">Crear Subcategoría</button>
            </div>

        </form>
    </div>




    <x-footer />
    <script src="{{ asset('js/desplegable.js') }}"></script>
    <script>
        document.getElementById('main_category_id').addEventListener('change', function() {
            var mainCategoryId = this.value;
            var categoryOptions = document.getElementById('category_id').options;

            // Mostrar solo las categorías relacionadas con la categoría principal seleccionada
            for (var i = 0; i < categoryOptions.length; i++) {
                var categoryOption = categoryOptions[i];
                if (categoryOption.dataset.mainCategoryId == mainCategoryId || mainCategoryId === '') {
                    categoryOption.style.display = '';
                } else {
                    categoryOption.style.display = 'none';
                }
            }
        });
    </script>



</body>

</html>