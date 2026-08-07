<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('img/logos sama/logosama.jpg') }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/style/admin/subsubsubcategories.css') }}">
</head>

<body>

    <x-header />
    <x-headersama />
    <x-nav />
    <x-header-admin />

    <h2>Añadir SubCategoria 3</h2>

    <div class="container mt-4">

        <div class="form-category">
            <form action="{{ route('admin.storeSubSubSubcategory') }}" method="POST">
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
                    <label for="category_id">Categoría secundaria:</label>
                    <select name="category_id" id="category_id" required>
                        <option value="">Selecciona una categoría secundaria</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}" data-main-category-id="{{ $category->main_category_id }}">{{ $category->nombre }}</option>
                        @endforeach
                    </select>
                </div><br>

                <div class="form-group">
                    <label for="subcategory_id">Subcategoría:</label>
                    <select name="subcategory_id" id="subcategory_id" required>
                        <option value="">Selecciona una subcategoría</option>
                        @foreach ($subcategories as $subcategory)
                        <option value="{{ $subcategory->id }}" data-category-id="{{ $subcategory->category_id }}">{{ $subcategory->nombre }}</option>
                        @endforeach
                    </select>
                </div><br>

                <div class="form-group">
                    <label for="sub_subcategory_id">SubSubcategoría:</label>
                    <select name="sub_subcategory_id" id="sub_subcategory_id" class="form-select" required>
                        <option value="">Selecciona una subsubcategoría</option>
                        @foreach ($subsubcategories as $subsubcategory)
                        <option value="{{ $subsubcategory->id }}" data-subcategory-id="{{ $subsubcategory->subcategory_id }}">{{ $subsubcategory->nombre }}</option>
                        @endforeach
                    </select>
                </div><br>

                <div class="crear">
                    <button type="submit" class="btn btn-primary">Crear Subcategoría 3</button>
                </div>
            </form>
        </div>

        <x-footer />
        <script src="{{ asset('js/desplegable.js') }}"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {

                const mainSelect = document.getElementById('main_category_id');
                const categorySelect = document.getElementById('category_id');
                const subcategorySelect = document.getElementById('subcategory_id');
                const subsubSelect = document.getElementById('sub_subcategory_id');

                // 🔹 Filtrar categorías cuando cambia la principal
                mainSelect.addEventListener('change', function() {
                    const mainId = this.value;

                    Array.from(categorySelect.options).forEach(option => {
                        if (!option.value) return; // saltar "Seleccionar..."
                        option.style.display = (option.dataset.mainCategoryId === mainId) ? '' : 'none';
                    });

                    categorySelect.value = '';
                    subcategorySelect.value = '';
                    subsubSelect.value = '';

                    hideAllOptions(subcategorySelect);
                    hideAllOptions(subsubSelect);
                });

                // 🔹 Filtrar subcategorías cuando cambia la categoría
                categorySelect.addEventListener('change', function() {
                    const categoryId = this.value;

                    Array.from(subcategorySelect.options).forEach(option => {
                        if (!option.value) return;
                        option.style.display = (option.dataset.categoryId === categoryId) ? '' : 'none';
                    });

                    subcategorySelect.value = '';
                    subsubSelect.value = '';
                    hideAllOptions(subsubSelect);
                });

                // 🔹 Filtrar subsubcategorías cuando cambia la subcategoría
                subcategorySelect.addEventListener('change', function() {
                    const subcategoryId = this.value;

                    Array.from(subsubSelect.options).forEach(option => {
                        if (!option.value) return;
                        option.style.display = (option.dataset.subcategoryId === subcategoryId) ? '' : 'none';
                    });

                    subsubSelect.value = '';
                });

                // 🔹 Función auxiliar para ocultar todas las opciones
                function hideAllOptions(select) {
                    Array.from(select.options).forEach(option => {
                        if (!option.value) return;
                        option.style.display = 'none';
                    });
                }

            });
        </script>

</body>

</html>