<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('img/logos sama/logosama.jpg') }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('/style/auth/login.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <x-header />
    <x-headersama /> 
    <x-nav />
    <div class="container">
        <div class="wrapper">
            <div class="form-box login">
                <h2>Iniciar Sesión</h2>
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="input-box" id="email">
                        <label for="email" class="col-md-4 col-form-label text-md-right">Correo electrónico</label>

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
                        <label for="password" class="col-md-4 col-form-label text-md-right">Contraseña</label>

                        <div class="col-md-6">
                            <input id="txtPassword" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            <div class="input-group-append">
                                <button id="show_password" class="btnpassword" type="button" onclick="mostrarPassword()"> <span class="fa fa-eye-slash icon"></span> </button>
                            </div>

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="forgot">
                        <a href="#">¿Olvidaste tu contraseña?</a>
                    </div>
                    <button type="submit" class="btn">
                        {{ __('Iniciar sesión') }}
                    </button>
                    <div class="login-register">
                        <p>¿No tienes cuenta?<a href="{{ route('register') }}"> Registrate</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <x-footer />
    <script src="{{ asset('js/mostrarContraseña.js') }}"></script>
    <script src="{{ asset('js/desplegable.js') }}"></script>
</body>

</html>