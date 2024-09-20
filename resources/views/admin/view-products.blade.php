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
    <link rel="stylesheet" href="{{ asset('/style/admin/view-products.css') }}">
</head>

<body>

    <x-header />
    <x-headersama />
    <x-nav />
    <x-header-admin />

    <div class="table-container">
        <h3>Productos</h3>
        <form action="{{ route('admin-search-products') }}" method="get" id="buscador">
            <input type="text" name="search" placeholder="Buscar Producto...">
            <button type="submit">Buscar</button>
        </form>

        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif

        <form action="{{ route('products.bulk-delete') }}" method="POST">
            @csrf
            @method('DELETE')

            <input type="hidden" name="page" value="{{ request()->get('page', 1) }}">

            <table class="products-table">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="select-all"></th>
                        <th>Nombre</th>
                        <th data-sort="asc" id="precio-header">Precio</th>
                        <th>Precio Oferta</th>
                        <th>Marca</th>
                        <th>Proveedor</th>
                        <th>Categora</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($products as $product)
                    <tr>
                        <td><input type="checkbox" name="product_ids[]" value="{{ $product->id }}"></td>
                        <td>{{ $product->nombre_es }}</td>
                        <td>{{ $product->precio_es }}€</td>
                        <td>{{ $product->precio_oferta_es }}€</td>
                        <td>{{ $product->marca }}</td>
                        <td>{{ $product->proveedor }}</td>
                        <td>
                            @if ($product->mainCategory)
                            {{ $product->mainCategory->nombre }}
                            @else
                            Sin categoría
                            @endif
                        </td>
                        <td class="action-buttons">
                            <a href="{{ route('admin-edit-products', $product->id) }}" class="edit-button">Editar</a>
                            <form action="{{ route('admin-delete-products', $product->id) }}" method="post" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este usuario?')">
                                @csrf
                                @method('delete')
                                <button type="submit" class="delete-button">Borrar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table><br>

            <div class="d-flex justify-content-center">
                <button type="submit" id="btn-borrar" class="btn btn-danger btn-lg">Eliminar seleccionados</button>
            </div>

        </form>

    </div>

    <div class="pagination">
        {{ $products->appends(request()->query())->links() }}
    </div>

    <x-footer />
    <script src="{{ asset('js/desplegable.js') }}"></script>
    <script>
        document.getElementById('select-all').onclick = function() {
            var checkboxes = document.getElementsByName('product_ids[]');
            for (var checkbox of checkboxes) {
                checkbox.checked = this.checked;
            }
        };
    </script>
</body>


</html>