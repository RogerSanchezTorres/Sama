<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('img/logos sama/logosama.jpg') }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('/style/admin/subsubsubsubcategories.css') }}">
</head>

<body>

    <x-header />
    <x-headersama />
    <x-nav />
    <x-header-admin />

    <h2>Añadir Subcategoría 4</h2>
    <div class="container mt-4">

        <div class="form-category">
            <form action="{{ route('admin.storeSubSubSubSubcategory') }}" method="POST">
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

                <div class="form-group">
                    <label for="sub_subcategory_id">SubSubSubcategoría:</label>
                    <select name="sub_sub_subcategory_id" id="sub_sub_subcategory_id" class="form-select" required>
                        <option value="">Selecciona una subsubsubcategoría</option>
                        @foreach($subsubsubcategories as $subsubsubcategory)
                        <option value="{{ $subsubsubcategory->id }}" data-subsubcategory-id="{{ $subsubsubcategory->sub_subcategory_id }}">
                            {{ $subsubsubcategory->nombre }}
                        </option>
                        @endforeach
                    </select>
                </div><br>

                <div class="crear">
                    <button type="submit" class="btn btn-primary">Crear Subcategoría 4</button>
                </div>
            </form>
        </div>
    </div>

    <x-footer />
    <script src="{{ asset('js/desplegable.js') }}"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const main = document.getElementById("main_category_id");
            const cat = document.getElementById("category_id");
            const sub = document.getElementById("subcategory_id");
            const sub2 = document.getElementById("sub_subcategory_id");
            const sub3 = document.getElementById("sub_sub_subcategory_id");

            function filtrar(select, atributo, valor) {
                [...select.options].forEach(opt => {
                    if (opt.value === "" || opt.dataset[atributo] == valor) {
                        opt.style.display = "";
                    } else {
                        opt.style.display = "none";
                    }
                });
                if (select.selectedOptions[0]?.style.display === "none") select.value = "";
            }

            function actualizar() {
                filtrar(cat, "mainCategoryId", main.value);
                filtrar(sub, "categoryId", cat.value);
                filtrar(sub2, "subcategoryId", sub.value);
                filtrar(sub3, "subsubcategoryId", sub2.value);
            }

            main.addEventListener("change", actualizar);
            cat.addEventListener("change", actualizar);
            sub.addEventListener("change", actualizar);
            sub2.addEventListener("change", actualizar);

            actualizar();
        });
    </script>

</body>

</html>