<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('img/logos sama/logosama.jpg') }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('/style/admin/edit-products.css') }}">
</head>

<body>

    <x-header />
    <x-headersama />
    <x-nav />
    <x-header-admin />

    <form method="POST" action="{{ route('admin-update-products', $product->id) }}" id="edit-products" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="nombre_es" value="{{ $product->nombre_es }}" class="form-control">

        <label for="precio">Precio</label>
        <input type="text" id="precio" name="precio_es" value="{{ $product->precio_es }}" class="form-control">

        <label for="precio_oferta">Precio Oferta</label>
        <input type="text" id="precio_oferta" name="precio_oferta_es" value="{{ $product->precio_oferta_es }}" class="form-control">

        <label for="marca">Marca</label>
        <input type="text" id="marca" name="marca" value="{{ $product->marca }}" class="form-control">

        <label for="referencia">Referencia</label>
        <input type="text" id="referencia" name="referencia" value="{{ $product->referencia }}" class="form-control">

        <label for="proveedor">Proveedor</label>
        <input type="text" id="proveedor" name="proveedor" value="{{ $product->proveedor }}" class="form-control"><br><br>

        <label for="main_category">Categoría Principal</label>
        <select id="main_category_id" name="main_category_id" class="form-control" required>
            @foreach ($mainCategories as $mainCategory)
            <option value="{{ $mainCategory->id }}" {{ $product->main_category_id == $mainCategory->id ? 'selected' : '' }}>
                {{ $mainCategory->nombre }}
            </option>
            @endforeach
        </select>

        <label for="category_id">Categoría Secundaria</label>
        <select id="category_id" name="category_id" class="form-control">
            <option value=""></option>
            @foreach($categories as $category)
            <option value="{{ $category->id }}" data-main-category-id="{{ $category->main_category_id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                {{ $category->nombre }}
            </option>
            @endforeach
        </select><br><br>


        <label for="subcategory_id">Subcategoría</label>
        <select id="subcategory_id" name="subcategory_id" class="form-control">
            <option value=""></option>
            @foreach($subcategories as $subcategory)
            <option value="{{ $subcategory->id }}" data-category-id="{{ $subcategory->category_id }}" {{ $product->subcategory_id == $subcategory->id ? 'selected' : '' }}>
                {{ $subcategory->nombre }}
            </option>
            @endforeach
        </select>

        <label for="subsubcategory_id">Subsubcategoría</label>
        <select id="subsubcategory_id" name="subsubcategory_id" class="form-control">
            <option value=""></option>
            @foreach($subsubcategories as $subsubcategory)
            <option value="{{ $subsubcategory->id }}" data-subcategory-id="{{ $subsubcategory->subcategory_id }}" {{ $product->subsubcategory_id == $subsubcategory->id ? 'selected' : '' }}>
                {{ $subsubcategory->nombre }}
            </option>
            @endforeach
        </select>


        <!--<label for="minor_category_id">Minor Category</label>
        <select id="minor_category_id" name="minor_category_id" class="form-control">
            <option value=""></option>
            @foreach($minorCategories as $minorCategory)
            <option value="{{ $minorCategory->id }}" data-subcategory-id="{{ $minorCategory->subcategory_id }}" {{ $product->minor_category_id == $minorCategory->id ? 'selected' : '' }}>
                {{ $minorCategory->nombre }}
            </option>
            @endforeach
        </select>-->


        <div class="form-group">
            <label for="img">Imagen del Producto</label>
            <input type="file" name="img[]" id="img" multiple accept="image/*">


            <label for="pdf" id="pdf-text">Archivo PDF</label>
            <input type="file" id="pdf" name="pdf" class="form-control">
        </div>

        <div class="description">
            <label for="descripcion">Descripción</label>
            <input type="text" id="descripcion" name="descripcion" value="{{ $product->descripcion }}" class="form-control">
        </div>

        
        <div class="detalles_lista">
            <label for="detalles_lista">Detalles</label>
            <div id="detalles-container">
                @if($product->detalles_lista)
                @foreach(json_decode($product->detalles_lista, true) as $detalle)
                <input type="text" name="detalles_lista[]" value="{{ $detalle }}" class="form-control mb-2">
                @endforeach
                @else
                <input type="text" name="detalles_lista[]" class="form-control mb-2">
                @endif
            </div>
            <button type="button" id="add-detalle" class="btn btn-primary btn-sm mt-2">Agregar Detalle</button>
        </div>


        <div class="btnSave">
            <button type="submit" aria-label="Actualizar Producto">Actualizar Producto</button>
        </div>

    </form>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <x-footer />

    <script src="{{ asset('js/detalles.js') }}"></script>
    <script>
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

            document.getElementById('category_id').value = '';
            var subcategoryOptions = document.getElementById('subcategory_id').options;
            for (var i = 0; i < subcategoryOptions.length; i++) {
                subcategoryOptions[i].style.display = 'none';
            }
        });

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
        });

        // Pre-filtrar categorías y subcategorías al cargar la página
        window.addEventListener('DOMContentLoaded', function() {
            var mainCategorySelect = document.getElementById('main_category_id');
            var categorySelect = document.getElementById('category_id');
            var subcategorySelect = document.getElementById('subcategory_id');

            var selectedMainCategoryId = mainCategorySelect.value;
            var selectedCategoryId = categorySelect.value;

            // Filtrar categorías
            var categoryOptions = categorySelect.options;
            for (var i = 0; i < categoryOptions.length; i++) {
                var categoryOption = categoryOptions[i];
                if (categoryOption.dataset.mainCategoryId == selectedMainCategoryId || selectedMainCategoryId === '') {
                    categoryOption.style.display = '';
                } else {
                    categoryOption.style.display = 'none';
                }
            }

            // Filtrar subcategorías
            var subcategoryOptions = subcategorySelect.options;
            for (var i = 0; i < subcategoryOptions.length; i++) {
                var subcategoryOption = subcategoryOptions[i];
                if (subcategoryOption.dataset.categoryId == selectedCategoryId || selectedCategoryId === '') {
                    subcategoryOption.style.display = '';
                } else {
                    subcategoryOption.style.display = 'none';
                }
            }
        });

        document.getElementById('subcategory_id').addEventListener('change', function() {
            const selectedSubcategory = this.value;
            const minorCategories = document.querySelectorAll('#minor_category_id option');

            minorCategories.forEach(option => {
                if (option.dataset.subcategoryId === selectedSubcategory || option.value === "") {
                    option.style.display = 'block';
                } else {
                    option.style.display = 'none';
                }
            });
        });
    </script>

    <script src="{{ asset('js/desplegable.js') }}"></script>
</body>


</html>