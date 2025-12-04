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

        <style>
            /* --- Diseño general --- */
            .grid-container {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(450px, 1fr));
                gap: 30px;
                margin-bottom: 50px;
            }

            .card {
                border: 1px solid #ddd;
                border-radius: 10px;
                overflow: hidden;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
                background: white;
                transition: transform 0.2s ease, box-shadow 0.2s ease;
            }

            .card:hover {
                transform: translateY(-3px);
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            }

            .card-header {
                background-color: #f7f7f7;
                padding: 12px 18px;
                border-bottom: 1px solid #ddd;
                font-weight: bold;
                font-size: 1.1rem;
            }

            .card-body {
                padding: 0;
            }

            .table {
                width: 100%;
                border-collapse: collapse;
            }

            .table thead {
                background-color: #f1f1f1;
            }

            .table th,
            .table td {
                padding: 10px 15px;
                border-bottom: 1px solid #eee;
                text-align: left;
            }

            .table tr:last-child td {
                border-bottom: none;
            }

            .btn-danger {
                background-color: #dc3545;
                color: white;
                border: none;
                padding: 5px 10px;
                border-radius: 5px;
                font-size: 0.9rem;
                transition: background 0.2s;
                cursor: pointer;
                text-decoration: none;
            }

            .btn-danger:hover {
                background-color: #c82333;
            }

            /* --- Responsive para móviles --- */
            @media (max-width: 600px) {
                .grid-container {
                    grid-template-columns: 1fr;
                    gap: 20px;
                }

                h1 {
                    font-size: 1.5rem;
                }
            }
        </style>

        <div class="grid-container">
            <!-- Categorías principales -->
            <div class="card">
                <div class="card-header">Categorías Principales</div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th class="text-right">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($maincategories as $maincategory)
                            <tr>
                                <td>{{ $maincategory->nombre }}</td>
                                <td class="text-right">
                                    <a href="{{ route('maincategory.delete', $maincategory->id) }}" class="btn btn-danger" onclick="return confirm('¿Eliminar esta categoría principal?')">Eliminar</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Categorías -->
            <div class="card">
                <div class="card-header">Categorías</div>
                <div class="card-body">
                    <table class="table">
                        <thead>
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
                                    <a href="{{ route('category.delete', $category->id) }}" class="btn btn-danger" onclick="return confirm('¿Eliminar esta categoría?')">Eliminar</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Subcategorías -->
            <div class="card">
                <div class="card-header">Subcategorías</div>
                <div class="card-body">
                    <table class="table">
                        <thead>
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
                                    <a href="{{ route('subcategory.delete', $subcategory->id) }}" class="btn btn-danger" onclick="return confirm('¿Eliminar esta subcategoría?')">Eliminar</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- SubSubcategorías -->
            <div class="card">
                <div class="card-header">SubSubcategorías</div>
                <div class="card-body">
                    <table class="table">
                        <thead>
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
                                    <a href="{{ route('subsubcategories.destroy', $subsubcategory->id) }}" class="btn btn-danger" onclick="return confirm('¿Eliminar esta subsubcategoría?')">Eliminar</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- SubSubSubcategorías -->
            <div class="card">
                <div class="card-header">SubSubSubcategorías</div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>SubSubcategoría</th>
                                <th class="text-right">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($subsubsubcategories as $subsubsubcategory)
                            <tr>
                                <td>{{ $subsubsubcategory->nombre }}</td>
                                <td>{{ $subsubsubcategory->subsubcategory->nombre ?? 'Sin asignar' }}</td>
                                <td class="text-right">
                                    <a href="{{ route('subsubsubcategories.delete', $subsubsubcategory->id) }}" class="btn btn-danger" onclick="return confirm('¿Eliminar esta subsubsubcategoría?')">Eliminar</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- SubSubSubSubcategorías -->
            <div class="card">
                <div class="card-header">SubSubSubSubcategorías</div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>SubSubSubcategoría</th>
                                <th class="text-right">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($subsubsubsubcategories as $subsubsubsubcategory)
                            <tr>
                                <td>{{ $subsubsubsubcategory->nombre }}</td>
                                <td>{{ $subsubsubsubcategory->subsubsubcategory->nombre ?? 'Sin asignar' }}</td>
                                <td class="text-right">
                                    <a href="{{ route('subsubsubsubcategories.delete', $subsubsubsubcategory->id) }}"
                                        class="btn btn-danger"
                                        onclick="return confirm('¿Eliminar esta subsubsubsubcategoría?')">
                                        Eliminar
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>



        <x-footer />
        <script src="{{ asset('js/desplegable.js') }}"></script>
</body>

</html>