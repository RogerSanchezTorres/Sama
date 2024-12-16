<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('img/logos sama/logosama.jpg') }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('/style/admin/subsubcategories.css') }}">
</head>

<body>
    <x-header />
    <x-headersama />
    <x-nav />
    <x-header-admin />

    <h2>Añadir Subcategoria 2</h2>

    <div class="form-category">
        <form action="{{ route('admin.storeSubSubcategory') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
            </div>
            <div class="form-group">
                <label for="slug">Slug</label>
                <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug') }}" required>
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
                <label for="category_id" class="form-label">Categoría secundaria:</label>
                <select name="category_id" id="category_id" required>
                    <option value="">Selecciona una subcategoría</option>
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}" data-main-category-id="{{ $category->main_category_id }}">{{ $category->nombre }}</option>
                    @endforeach
                </select>
            </div><br>

            <div class="form-group">
                <label for="subcategory_id" class="form-label">Subcategoría Principal:</label>
                <select name="subcategory_id" id="subcategory_id" class="form-control" required>
                    <option value="">Seleccione una subcategoría</option>
                    @foreach($subcategories as $subcategory)
                    <option value="{{ $subcategory->id }}" data-category-id="{{ $subcategory->category_id }}">{{ $subcategory->nombre }}</option>
                    @endforeach
                </select>
            </div><br>

            <div class="crear">
                <button type="submit" class="btn btn-primary">Crear Subsubcategoría</button>
            </div>
        </form>
    </div>

    <x-footer />
    <script src="{{ asset('js/desplegable.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        // Filtrar categorías secundarias según la categoría principal seleccionada
        document.getElementById('main_category_id').addEventListener('change', function() {
            var mainCategoryId = this.value;
            var categoryOptions = document.getElementById('category_id').options;

            for (var i = 0; i < categoryOptions.length; i++) {
                var categoryOption = categoryOptions[i];
                if (categoryOption.dataset.mainCategoryId == mainCategoryId || mainCategoryId === '') {
                    categoryOption.style.display = '';
                } else {
                    categoryOption.style.display = 'none';
                }
            }

            // Restablecer selección de categorías y subcategorías
            document.getElementById('category_id').value = '';
            document.getElementById('subcategory_id').value = '';

            // Ocultar todas las subcategorías
            var subcategoryOptions = document.getElementById('subcategory_id').options;
            for (var i = 0; i < subcategoryOptions.length; i++) {
                subcategoryOptions[i].style.display = 'none';
            }
        });

        // Filtrar subcategorías principales según la categoría secundaria seleccionada
        document.getElementById('category_id').addEventListener('change', function() {
            var categoryId = this.value;
            var subcategoryOptions = document.getElementById('subcategory_id').options;

            for (var i = 0; i < subcategoryOptions.length; i++) {
                var subcategoryOption = subcategoryOptions[i];
                if (subcategoryOption.dataset.categoryId == categoryId || categoryId === '') {
                    subcategoryOption.style.display = '';
                } else {
                    subcategoryOption.style.display = 'none';
                }
            }

            // Restablecer selección de subcategorías
            document.getElementById('subcategory_id').value = '';
        });
    </script>


</body>

</html>