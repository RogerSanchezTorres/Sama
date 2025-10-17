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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>

<body>

    <x-header />
    <x-headersama />
    <x-nav />
    <x-header-admin />

    <div class="container my-5">
        <div class="card shadow-sm p-4">
            <h3 class="text-center mb-4 fw-bold">Editar Producto</h3>
            <form method="POST" action="{{ route('admin-update-products', $product->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Información Principal --}}
                <div class="row mb-3 align-items-center">
                    <div class="col-md-4">
                        <label for="nombre" class="fw-bold mb-1">Nombre</label>
                        <input type="text" name="nombre_es" value="{{ $product->nombre_es }}" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label for="precio" class="fw-bold mb-1">Precio</label>
                        <input type="number" name="precio_es" value="{{ $product->precio_es }}" class="form-control" step="0.01">
                    </div>
                    <div class="col-md-4">
                        <label for="precio_oferta" class="fw-bold mb-1">Precio Oferta</label>
                        <input type="number" name="precio_oferta_es" value="{{ $product->precio_oferta_es }}" class="form-control" step="0.01">
                    </div>
                    <div class="col-md-6">
                        <label class="fw-bold mb-1" for="stock">Stock</label>
                        <input type="number" id="stock" name="stock" class="form-control" value="{{ old('stock', $product->stock) }}" min="0">
                    </div>
                    <div class="col-md-4" style="margin-top: 15px;">
                        <label for="marca" class="fw-bold mb-1">Marca</label>
                        <input type="text" name="marca" value="{{ $product->marca }}" class="form-control">
                    </div>
                    <div class="col-md-4" style="margin-top: 15px;">
                        <label for="referencia" class="fw-bold mb-1">Referencia</label>
                        <input type="text" name="referencia" value="{{ $product->referencia }}" class="form-control">
                    </div>
                    <div class="col-md-4" style="margin-top: 15px;">
                        <label for="proveedor" class="fw-bold mb-1">Proveedor</label>
                        <input type="text" name="proveedor" value="{{ $product->proveedor }}" class="form-control">
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6" style="margin-top: 15px;">
                            <label for="proveedor_logo" class="fw-bold mb-1">Logo del Proveedor</label>
                            <input type="file" name="proveedor_logo" class="form-control">
                        </div>
                    </div>

                    {{-- Vista previa del logo actual, si existe --}}
                    @if ($product->proveedor_logo_path ?? false)
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="fw-bold mb-1">Logo Actual</label><br>
                            <img src="{{ asset($product->proveedor_logo_path) }}" alt="Logo del Proveedor" class="img-fluid" style="max-width: 150px; max-height: 150px;">
                            <div class="form-check mt-2">
                                <input type="checkbox" name="delete_proveedor_logo" value="1" id="delete_proveedor_logo" class="form-check-input">
                                <label for="delete_proveedor_logo" class="form-check-label">Eliminar Logo</label>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

                <div class="col-md-6">
                    <label for="pdf" class="fw-bold mb-1">Archivo PDF</label>
                    <input type="file" id="pdf" name="pdf" class="form-control">

                    @if($product->pdf)
                    <p>Archivo actual: <a href="{{ asset('storage/' . $product->pdf) }}" target="_blank">Ver PDF</a></p>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="delete_pdf" name="delete_pdf" value="1">
                        <label class="form-check-label" for="delete_pdf">Eliminar PDF</label>
                    </div>
                    @endif
                </div><br>


                {{-- Categorías --}}
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="fw-bold mb-1" for="main_category">Categoría Principal</label>
                        <select name="main_category_id" class="form-select" id="main_category_id">
                            <option value="">Selecciona</option>
                            @foreach ($mainCategories as $mainCategory)
                            <option value="{{ $mainCategory->id }}" {{ $product->main_category_id == $mainCategory->id ? 'selected' : '' }}>
                                {{ $mainCategory->nombre }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="fw-bold mb-1" for="category_id">Categoría Secundaria</label>
                        <select id="category_id" name="category_id" class="form-select">
                            <option value="">Selecciona</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}" data-main-category-id="{{ $category->main_category_id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->nombre }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6" style="margin-top: 15px;">
                        <label class="fw-bold mb-1" for="subcategory_id">Subcategoría</label>
                        <select id="subcategory_id" name="subcategory_id" class="form-select">
                            <option value="">Selecciona</option>
                            @foreach($subcategories as $subcategory)
                            <option value="{{ $subcategory->id }}" data-category-id="{{ $subcategory->category_id }}" {{ $product->subcategory_id == $subcategory->id ? 'selected' : '' }}>
                                {{ $subcategory->nombre }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6" style="margin-top: 15px;">
                        <label class="fw-bold mb-1" for="subsubcategory_id">Subsubcategoría</label>
                        <select id="subsubcategory_id" name="subsubcategory_id" class="form-select">
                            <option value="">Selecciona</option>
                            @foreach($subsubcategories as $subsubcategory)
                            <option value="{{ $subsubcategory->id }}"
                                data-subcategory-id="{{ $subsubcategory->subcategory_id }}" {{ $product->subsubcategory_id == $subsubcategory->id ? 'selected' : '' }}> {{ $subsubcategory->nombre }}
                            </option>

                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6" style="margin-top: 15px;">
                        <label class="fw-bold mb-1" for="subsubsubcategory_id">Subsubsubcategoría</label>
                        <select id="subsubsubcategory_id" name="sub_sub_subcategory_id" class="form-select">
                            <option value="">Selecciona</option>
                            @foreach($subsubsubcategories as $subsubsubcategory)
                            <option value="{{ $subsubsubcategory->id }}"
                                data-subsubcategory-id="{{ $subsubsubcategory->sub_subcategory_id }}"
                                {{ $product->sub_sub_subcategory_id == $subsubsubcategory->id ? 'selected' : '' }}>
                                {{ $subsubsubcategory->nombre }}
                            </option>
                            @endforeach
                        </select>
                    </div>


                    {{-- Imágenes --}}
                    <div class="row mb-3">
                        <div class="col-md-6" style="margin-top: 15px;">
                            <label class="fw-bold mb-1">Imagen del Producto</label>
                            <input type="file" name="img[]" class="form-control" multiple>
                        </div>
                    </div>

                    <div class="row">
                        @php
                        $images = json_decode($product->img, true);
                        @endphp

                        @if (!empty($images))
                        @foreach ($images as $index => $img)
                        <div class="col-md-3">
                            <img src="{{ asset($img) }}" class="img-fluid mb-3">
                            <div class="form-check">
                                <input type="checkbox" name="delete_images[]" value="{{ $index }}" class="form-check-input" id="delete_image_{{ $index }}" multiple>
                                <label class="form-check-label" for="delete_image_{{ $index }}">Eliminar</label>
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>

                    {{-- Descripción --}}
                    <div class="mb-3">
                        <label for="descripcion" class="fw-bold mb-1">Descripción</label>
                        <textarea name="descripcion" rows="3" class="form-control">{{ $product->descripcion }}</textarea>
                    </div>

                    {{-- Detalles Lista --}}
                    <div class="detalles_lista mb-3">
                        <label for="detalles_lista" class="fw-bold mb-1">Detalles</label>
                        <div id="detalles-container">
                            @php
                            if (is_string($product->detalles_lista)) {
                            $detalles = json_decode($product->detalles_lista, true) ?? [];
                            } else {
                            $detalles = $product->detalles_lista ?? [];
                            }
                            @endphp
                            @if (!empty($detalles))
                            @foreach ($detalles as $detalle)
                            <div class="detalle-item d-flex align-items-center mb-2">
                                <input type="text" name="detalles_lista[]" value="{{ $detalle }}" class="form-control me-2">
                                <button type="button" class="btn btn-danger btn-sm btn-remove-detalle">Eliminar</button>
                            </div>
                            @endforeach
                            @else
                            <div class="detalle-item d-flex align-items-center mb-2">
                                <input type="text" name="detalles_lista[]" class="form-control me-2">
                                <button type="button" class="btn btn-danger btn-sm btn-remove-detalle">Eliminar</button>
                            </div>
                            @endif
                        </div>
                        <button type="button" id="add-detalle" class="btn btn-sm btn-primary mt-2">Agregar Detalle</button>
                    </div>


                    {{-- Botón Guardar --}}
                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-warning px-5 fw-bold">
                            <i class="fas fa-save"></i> Guardar Cambios
                        </button>
                    </div>
            </form>
        </div>
    </div>

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
        document.addEventListener('DOMContentLoaded', function() {
            const subcategorySelect = document.getElementById('subcategory_id');
            const subsubcategorySelect = document.getElementById('subsubcategory_id');

            function actualizarSubsubcategorias() {
                const selectedSubcategoryId = subcategorySelect.value;

                // Iterar sobre las opciones y mostrar solo las que correspondan a la subcategoría seleccionada
                subsubcategorySelect.querySelectorAll('option').forEach(option => {
                    if (option.value === "" || option.dataset.subcategoryId === selectedSubcategoryId) {
                        option.style.display = 'block';
                    } else {
                        option.style.display = 'none';
                    }
                });

                // Si la opción seleccionada ya no es válida, resetear el select
                if (!subsubcategorySelect.querySelector("option:checked") || subsubcategorySelect.querySelector("option:checked").style.display === 'none') {
                    subsubcategorySelect.value = "";
                }
            }

            // Ejecutar al cambiar la subcategoría
            subcategorySelect.addEventListener('change', actualizarSubsubcategorias);

            // Ejecutar al cargar la página si ya hay una subcategoría seleccionada
            actualizarSubsubcategorias();
        });




        document.addEventListener('DOMContentLoaded', () => {
            const detallesContainer = document.getElementById('detalles-container');
            const btnAddDetalle = document.getElementById('add-detalle');

            // Agregar un nuevo detalle
            btnAddDetalle.addEventListener('click', () => {
                const detalleItem = document.createElement('div');
                detalleItem.classList.add('detalle-item', 'd-flex', 'align-items-center', 'mb-2');
                detalleItem.innerHTML = `
    <input type="text" name="detalles_lista[]" class="form-control me-2">
    <button type="button" class="btn btn-danger btn-sm btn-remove-detalle">Eliminar</button>
    `;
                detallesContainer.appendChild(detalleItem);
            });

            // Eliminar un detalle
            detallesContainer.addEventListener('click', (event) => {
                if (event.target.classList.contains('btn-remove-detalle')) {
                    const detalleItem = event.target.closest('.detalle-item');
                    detallesContainer.removeChild(detalleItem);
                }
            });
        });

        document.querySelectorAll('.delete-pdf-form').forEach(form => {
            form.addEventListener('submit', function(event) {
                event.preventDefault();
                fetch(this.action, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    }).then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            this.closest('.pdf-container').remove(); // Ajusta según tu estructura HTML
                        }
                    });
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const subsubcategorySelect = document.getElementById('subsubcategory_id');
            const subsubsubcategorySelect = document.getElementById('subsubsubcategory_id');

            function actualizarSubsubsubcategorias() {
                const selectedSubsubcategoryId = subsubcategorySelect.value;

                subsubsubcategorySelect.querySelectorAll('option').forEach(option => {
                    if (option.value === "" || option.dataset.subsubcategoryId === selectedSubsubcategoryId) {
                        option.style.display = 'block';
                    } else {
                        option.style.display = 'none';
                    }
                });

                // Resetear selección si no coincide
                if (!subsubsubcategorySelect.querySelector("option:checked") || subsubsubcategorySelect.querySelector("option:checked").style.display === 'none') {
                    subsubsubcategorySelect.value = "";
                }
            }

            // Actualizar al cambiar subsubcategoría
            subsubcategorySelect.addEventListener('change', actualizarSubsubsubcategorias);

            // Ejecutar al cargar si ya hay una seleccionada
            actualizarSubsubsubcategorias();
        });
    </script>

    <script src="{{ asset('js/desplegable.js') }}"></script>
</body>


</html>