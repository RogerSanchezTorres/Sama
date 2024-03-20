<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('/style/admin/view-users.css') }}">

</head>

<body>
    <x-header />
    <x-headersama />
    <x-nav />
    <x-header-admin />

    <div class="table-container">
        <h3>Usuarios Registrados</h3>
        <form action="{{ route('admin-search-users') }}" method="get" id="buscador">
            <input type="text" name="search" placeholder="Buscar usuario...">
            <button type="submit">Buscar</button>
        </form>
        <table class="user-table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Correo Electrónico</th>
                    <th>Teléfono</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->surname }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phoneNumber }}</td>
                    <td>
                        @if($user->role)
                        {{ $user->role->role }}
                        @else
                        Sin rol asignado
                        @endif
                    </td>
                    <td class="action-buttons">
                        <a href="{{ route('admin-edit-user', $user->id) }}" class="edit-button">Editar</a>
                        <form action="{{ route('admin-delete-user', $user->id) }}" method="post" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este usuario?')">
                            @csrf
                            @method('delete')
                            <button type="submit" class="delete-button">Borrar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="pagination">
        {{ $users->appends(request()->query())->links() }}
    </div>

    <x-footer />
    <script src="{{ asset('js/desplegable.js') }}"></script>
</body>

</html>