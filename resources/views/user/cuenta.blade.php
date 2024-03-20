<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('/style/user/cuenta.css') }}">
</head>

<body>

    <x-header />
    <x-headersama /> 
    <x-nav />

    <div class="account-settings">
        <form method="post" action="{{ route('user-update-personal-details') }}" id="personal-details" name="personal-details">
            @csrf
            @method('put')
            <h3>Personal Details</h3>
            <label for="name">Nombre:</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}">

            <label for="name">Apellidos:</label>
            <input type="text" name="surname" id="surname" value="{{ old('surname', $user->surname) }}">

            <label for="email">Correo electrónico:</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}">

            <label for="phoneNumber">Teléfono:</label>
            <input type="text" name="phoneNumber" id="phoneNumber" value="{{ old('phoneNumber', $user->phoneNumber ?? '') }}">

            <button type="submit" id="save">Actualizar datos</button>
        </form>

        
        <form method="post" action="{{ route('user-update-billing-details') }}" id="biling-details" name="biling-details">
            @csrf
            @method('put')
            <h3>Billing Details</h3>
            <label for="address">Dirección:</label>
            <input type="text" name="address" id="address" value="{{ old('address', $user->billing->address ?? '') }}">

            <label for="city">Ciudad:</label>
            <input type="text" name="city" id="city" value="{{ old('city', $user->billing->city ?? '') }}">

            <label for="province">Provincia:</label>
            <input type="text" name="province" id="province" value="{{ old('province', $user->billing->province ?? '') }}">

            <label for="postalCode">Código Postal:</label>
            <input type="text" name="postalCode" id="postalCode" value="{{ old('postalCode', $user->billing->postalCode ?? '') }}">
            <label for="country">País:</label>
            <input type="text" name="country" id="country" value="{{ old('country', $user->billing->country ?? '') }}">

            <button type="submit" id="save">Actualizar datos</button>
        </form>

        
        <form method="post" action="{{ route('user-update-password') }}" id="update-password" name="update-password">
            @csrf
            @method('put')
            <h3>Password</h3>
            <label for="current_password">Contraseña antigua:</label>
            <input type="password" name="current_password" id="current_password" required>

            <label for="password">Contraseña nueva:</label>
            <input type="password" name="password" id="password" required>

            <label for="password_confirmation">Confirmar contraseña:</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required><br>
           
            @error('password')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <button type="submit" id="save">Actualizar contraseña</button>
        </form>
    </div>
    <x-footer />
    <script src="{{ asset('js/desplegable.js') }}"></script>
</body>

</html>