<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('img/logos sama/logosama.jpg') }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('/style/auth/register.css') }}">

</head>

<body>

<x-header />
    <div class="imglogo">
        <a href="{{ route('index') }}"><img src="{{ asset('img/logo-web-negro.svg') }}" alt="Logo"></a>
    </div>

    <div class="container">
        <div class="wrapper">
            <div class="form-box register">
                <h2>Crear una cuenta</h2>
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="name-surname">
                        <div class="input-box" id="name">
                            <label for="name">{{ __('Nombre') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="input-box" id="surname">
                            <label for="surname">{{ __('Apellidos') }}</label>

                            <div class="col-md-6">
                                <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ old('surname') }}" required autocomplete="surname" autofocus>

                                @error('surname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="input-box" id="email">
                        <label for="email">Correo electrónico</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="input-box" id="password">
                        <label for="password">Contraseña</label>

                        <div class="col-md-6">
                            <input id="txtPassword" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="input-box" id="confirm-password">
                            <label for="password-confirm">{{ __('Confirmar contraseña') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="input-box" id="date">
                            <label for="date">{{ __('Fecha de nacimiento') }}</label>

                            <div class="col-md-6">
                                <input id="date" type="date" name="date" autocomplete="date">
                                <h6>Opcional</h6>
                            </div>
                        </div>
                        <button type="submit" class="btn">
                            {{ __('Registrarse') }}
                        </button>
                        <div class="login-register">
                        <p>¿Ya tienes una cuenta?<a href="{{ route('login') }}"> Inicia sesión</a></p>
                    </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <x-footer />

</body>

</html>