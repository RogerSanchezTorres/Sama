<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('/style/admin/add-product.css') }}">
</head>

<body>

    <x-header />
    <x-headersama />
    <x-nav />
    <x-header-admin />

    <h2>Agregar Producto</h2>

    <div class="container">

        <form method="POST" action="{{ route('admin-store-producto') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="nombre">Nombre del Producto</label>
                <input type="text" name="nombre_es" id="nombre_es" class="form-control" required>
            </div>

            <div class="price">
                <div class="form-group">
                    <label for="precio">Precio</label>
                    <input type="double" name="precio_es" id="precio_es" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="precio_oferta">Precio de Oferta</label>
                    <input type="double" name="precio_oferta_es" id="precio_oferta_es" class="form-control">
                </div>
            </div>

            <div class="form-group">
                    <label for="proveedor">Proveedor</label>
                    <input type="rext" name="proveedor" id="proveedor" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="marca">Marca</label>
                    <input type="text" name="marca" id="marca" class="form-control" required>
                </div>

            <div class="form-group">
                <label for="imagen">Imagen del Producto</label>
                <input type="file" name="img" id="img" class="form-control-file" accept="image/*" required>
            </div>

            <div class="form-group">
                <label for="main_category">Categoría Principal</label>
                <select name="main_category" id="main_category" class="form-control" required>
                    @foreach ($mainCategories as $mainCategory)
                    <option value="{{ $mainCategory->id }}">{{ $mainCategory->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Agregar Producto</button>
        </form>
    </div>

    <x-footer />
</body>

</html>