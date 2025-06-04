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
    @if(session('success'))
    <div class="alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
    <div class="alert-error">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <h2 class="titulo-apartado">Crear Apartado</h2>

    <form action="{{ route('apartados.store') }}" method="POST" class="form-apartado">
        @csrf

        <label for="nombre" class="label-apartado">Nombre del apartado:</label>
        <input type="text" name="nombre" id="nombre" class="input-apartado" placeholder="Introduce un nombre" required>

        <button type="submit" class="btn-apartado">Guardar</button>
    </form>

    <style>
        .titulo-apartado {
            text-align: center;
            font-size: 24px;
            margin: 40px 0 20px;
            font-weight: 600;
        }

        .form-apartado {
            max-width: 500px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            gap: 20px;
            background-color: #f8f9fa;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .label-apartado {
            font-weight: 500;
            font-size: 16px;
            margin-bottom: 5px;
        }

        .input-apartado {
            padding: 10px 15px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 6px;
            transition: border-color 0.3s;
        }

        .input-apartado:focus {
            border-color: #e7af04;
            outline: none;
        }

        .btn-apartado {
            background-color: rgb(255, 191, 0);
            color: white;
            padding: 10px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-apartado:hover {
            background-color: rgb(226, 170, 3);
        }

        .alert-success {
            max-width: 500px;
            margin: 0 auto 20px;
            background-color: #d4edda;
            color: #155724;
            padding: 10px 15px;
            border: 1px solid #c3e6cb;
            border-radius: 6px;
        }

        .alert-error {
            max-width: 500px;
            margin: 0 auto 20px;
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px 15px;
            border: 1px solid #f5c6cb;
            border-radius: 6px;
        }

        .alert-error ul {
            margin: 0;
            padding-left: 20px;
        }
    </style>





    <x-footer />
    <script src="{{ asset('js/desplegable.js') }}"></script>
</body>

</html>