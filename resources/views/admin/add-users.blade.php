<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('/style/admin/add-users.css') }}">
</head>

<body>

    <x-header />
    <x-headersama />
    <x-nav />
    <x-header-admin />

    <div class="form-container">
        <h3>Crear Nuevo Usuario</h3>
        <form action="{{ route('admin-store-user') }}" method="post">
            @csrf
            <div class="name-surname">
                <div class="input-box" id="name">
                    <label for="name">Nombre:</label>
                    <input type="text" name="name" required>
                </div>

                <div class="input-box" id="surname">
                    <label for="surname">Apellido:</label>
                    <input type="text" name="surname" required>
                </div>

            </div>
            <div class="input-box" id="email">
                <label for="email">Correo Electrónico:</label>
                <input type="email" name="email" required>
            </div>
            
            <div class="password">
                <div class="input-box" id="passwd">
                    <label for="password">Contraseña:</label>
                    <input type="password" name="password" required>
                </div>

                <div class="input-box" id="confirm-passwd">
                    <label for="password_confirmation">Confirmar Contraseña:</label>
                    <input type="password" name="password_confirmation" required>
                </div>
            </div>


            <div class="input-box" id="phone">
                <label for="phoneNumber">Teléfono:</label>
                <input type="text" name="phoneNumber">
            </div>

            <div class="input-box" id="role">
                <label for="role_id">Rol:</label>
                <select name="role_id">
                    <option value="2">Usuario</option>
                    <option value="1">Administrador</option>
                </select>
            </div>

            <button type="submit" id="adduser">Crear Usuario</button>
        </form>
    </div>

    <x-footer />
</body>

</html>