<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('img/logos sama/logosama.jpg') }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('/style/admin/delete.css') }}">
</head>

<body>

    <x-header />
    <x-headersama />
    <x-nav />
    <x-header-admin />

    <div class="container mt-5">
        <h1 class="mb-4">Gestión de Categorías</h1>

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

        <div class="flex-container">
            <div class="card">
                <!-- Main Categories -->
                <div class="card-header">
                    <h2 class="h5 mb-0">Categorías Principales</h2>
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th>Nombre</th>
                                <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                <th class="text-right">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($maincategories as $maincategory)
                            <tr>
                                <td>{{ $maincategory->nombre }}</td>
                                <td></td>
                                <td class="text-right">
                                    <a href="{{ route('maincategory.delete', $maincategory->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de que quieres eliminar esta categoría principal?');">Eliminar</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card">
                <!-- Categories -->
                <div class="card-header">
                    <h2 class="h5 mb-0">Categorías</h2>
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th>Nombre</th>
                                <th>Categoría Principal</th>
                                <th class="text-right">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                            <tr>
                                <td>{{ $category->nombre }}</td>
                                <td>{{ $category->mainCategory->nombre }}</td>
                                <td class="text-right">
                                    <a href="{{ route('category.delete', $category->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de que quieres eliminar esta categoría?');">Eliminar</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card">
                <!-- Subcategories -->
                <div class="card-header">
                    <h2 class="h5 mb-0">Subcategorías</h2>
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th>Nombre</th>
                                <th>Categoría</th>
                                <th class="text-right">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($subcategories as $subcategory)
                            <tr>
                                <td>{{ $subcategory->nombre }}</td>
                                <td>{{ $subcategory->category->nombre }}</td>
                                <td class="text-right">
                                    <a href="{{ route('subcategory.delete', $subcategory->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de que quieres eliminar esta subcategoría?');">Eliminar</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card">
                <!-- Subsubcategories -->
                <div class="card-header">
                    <h2 class="h5 mb-0">SubSubcategorías</h2>
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th>Nombre</th>
                                <th>Subcategoría</th>
                                <th class="text-right">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($subsubcategories as $subsubcategory)
                            <tr>
                                <td>{{ $subsubcategory->nombre }}</td>
                                <td>{{ $subsubcategory->subcategory->nombre }}</td>
                                <td class="text-right">
                                    <a href="{{ route('subsubcategories.destroy', $subsubcategory->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de que quieres eliminar esta subsubcategoría?');">Eliminar</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <x-footer />
    <script src="{{ asset('js/desplegable.js') }}"></script>
</body>

</html>