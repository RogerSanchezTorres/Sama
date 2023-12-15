<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

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

    <form method="POST" action="{{ route('admin-update-products', $product->id) }}" id="edit-products">
        @csrf
        @method('PUT')

        <label for="nombre">Nombre</label>
        <input type="text" id="nombre" name="nombre" value="{{ $product->nombre_es }}" class="form-control">

        <label for="precio">Precio</label>
        <input type="text" id="precio" name="precio" value="{{ $product->precio_es }}" class="form-control">

        <label for="precio_oferta">Precio Oferta</label>
        <input type="text" id="precio_oferta" name="precio_oferta" value="{{ $product->precio_oferta_es }}" class="form-control">

        <label for="marca">Marca</label>
        <input type="text" id="marca" name="marca" value="{{ $product->marca }}" class="form-control">

        <label for="proveedor">Proveedor</label>
        <input type="text" id="proveedor" name="proveedor" value="{{ $product->proveedor }}" class="form-control">

        <label for="main_category">Categoria</label>
        <select id="main_category" name="main_category" class="form-control">
            @foreach ($mainCategories as $mainCategory)
            <option value="{{ $mainCategory->id }}" {{ $product->main_category_id == $mainCategory->id ? 'selected' : '' }}>
                {{ $mainCategory->nombre }}
            </option>
            @endforeach
        </select>
        <label for="descripcion">Descripción</label>
        <input type="text" id="descripcion" name="descripcion" value="{{ $product->descripcion }}" class="form-control">

        <div class="btnSave">
            <button type="submit" aria-label="Actualizar Producto">Actualizar Producto</button>
        </div>


    </form>


    <x-footer />
</body>


</html>