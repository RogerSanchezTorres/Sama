<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('img/logos sama/logosama.jpg') }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('/style/admin/edit-users.css') }}">

</head>

<body>
    <x-header />
    <x-headersama />
    <x-nav />
    <x-header-admin />

    <h3>Editar Usuario</h3>
    <form action="{{ route('admin-update-user', $user->id) }}" method="post" id="edit-users">
        @csrf
        @method('put')
        <label for="name">Nombre:</label>
        <input type="text" name="name" id="name" value="{{ $user->name }}" aria-label="Insert name">

        <label for="name">Apellidos:</label>
        <input type="text" name="surname" id="surname" value="{{ $user->surname }}" aria-label="Insert surname">

        <label for="email">Correo Electrónico:</label>
        <input type="email" name="email" id="email" value="{{ $user->email }}" aria-label="Insert email">

        <label for="phoneNumber">Teléfono:</label>
        <input type="text" name="phoneNumber" id="phoneNumber" value="{{ $user->phoneNumber }}" aria-label="Insert phone number">

        <label for="role">Rol:</label>
        <select name="role" id="role">
            <option value="admin" {{ $user->role_id === 1 ? 'selected' : '' }}>Administrador</option>
            <option value="profesional" {{ $user->role_id === 2 ? 'selected' : '' }}>Profesional</option>
            <option value="particular" {{ $user->role_id === 3 ? 'selected' : '' }}>Particular</option>
        </select>

        <div class="btnSave">
            <button type="submit" aria-label="Guardar cambios">Guardar Cambios</button>
        </div>
    </form>

    <x-footer />
    <script src="{{ asset('js/desplegable.js') }}"></script>
</body>

</html>