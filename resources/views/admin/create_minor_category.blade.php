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

    <div class="container">
        <h1>Crear Minor Category</h1>

        <form action="{{ route('admin.storeMinorCategory') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" class="form-control" value="{{ old('nombre') }}" required>
            </div>

            <div class="form-group">
                <label for="slug">Slug</label>
                <input type="text" id="slug" name="slug" class="form-control" value="{{ old('slug') }}" required>
            </div>

            <div class="form-group">
                <label for="main_category_id">Categoría Principal</label>
                <select id="main_category_id" name="main_category_id" class="form-control" required>
                    <option value="">Seleccionar</option>
                    @foreach($mainCategories as $mainCategory)
                    <option value="{{ $mainCategory->id }}">{{ $mainCategory->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="category_id">Categoría secundaria:</label>
                <select id="category_id" name="category_id" class="form-control" required>
                    <option value="">Seleccionar</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" data-main-category-id="{{ $category->main_category_id }}">{{ $category->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="subcategory_id">Subcategoría Principal:</label>
                <select id="subcategory_id" name="subcategory_id" class="form-control" required>
                    <option value="">Seleccionar</option>
                    @foreach($subcategories as $subcategory)
                    <option value="{{ $subcategory->id }}" data-category-id="{{ $subcategory->category_id }}">{{ $subcategory->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="subsubcategory_id">Subcategoría Secundaria:</label>
                <select id="subsubcategory_id" name="subsubcategory_id" class="form-control" required>
                    <option value="">Seleccionar</option>
                    @foreach($subsubcategories as $subsubcategory)
                    <option value="{{ $subsubcategory->id }}" data-subcategory-id="{{ $subsubcategory->subcategory_id }}">{{ $subsubcategory->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Crear</button>
        </form>
    </div>

    <x-footer />
    <script src="{{ asset('js/desplegable.js') }}"></script>
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

            // Restablecer selecciones dependientes
            document.getElementById('category_id').value = '';
            document.getElementById('subcategory_id').value = '';
            document.getElementById('subsubcategory_id').value = '';

            var subcategoryOptions = document.getElementById('subcategory_id').options;
            for (var i = 0; i < subcategoryOptions.length; i++) {
                subcategoryOptions[i].style.display = 'none';
            }

            var subsubcategoryOptions = document.getElementById('subsubcategory_id').options;
            for (var i = 0; i < subsubcategoryOptions.length; i++) {
                subsubcategoryOptions[i].style.display = 'none';
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

            // Restablecer selección de subcategorías secundarias
            document.getElementById('subcategory_id').value = '';
            document.getElementById('subsubcategory_id').value = '';

            var subsubcategoryOptions = document.getElementById('subsubcategory_id').options;
            for (var i = 0; i < subsubcategoryOptions.length; i++) {
                subsubcategoryOptions[i].style.display = 'none';
            }
        });

        // Filtrar subsubcategorías según la subcategoría seleccionada
        document.getElementById('subcategory_id').addEventListener('change', function() {
            var subcategoryId = this.value;
            var subsubcategoryOptions = document.getElementById('subsubcategory_id').options;

            for (var i = 0; i < subsubcategoryOptions.length; i++) {
                var subsubcategoryOption = subsubcategoryOptions[i];
                if (subsubcategoryOption.dataset.subcategoryId == subcategoryId || subcategoryId === '') {
                    subsubcategoryOption.style.display = '';
                } else {
                    subsubcategoryOption.style.display = 'none';
                }
            }

            // Restablecer selección de subsubcategorías
            document.getElementById('subsubcategory_id').value = '';
        });
    </script>




</body>

</html>