<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('img/logos sama/logosama.jpg') }}">
    <title>Tus datos | {{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('/style/user/dashboard.css') }}">
</head>

<body>

    <x-header />
    <x-headersama />
    <x-nav />

    <h1>Tu Información</h1>

    <form action="{{ route('logout') }}" method="post" id="logout">
        @csrf
        <button type="submit">Cerrar Sesión</button>
    </form>

    <div class="personal-details">
        <form>
            <label for="">Nombre:</label>
            <input type="text" name="name" id="name" value="{{ $user->name }}" aria-label="Insert name">
            <label for="">Apellidos:</label>
            <input type="text" name="surname" id="surname" value="{{ $user->surname }}" aria-label="Insert surname">
            <label for="">Correo Electrónico:</label>
            <input type="email" name="email" id="email" value="{{ $user->email }}" aria-label="Insert email">
            <div class="btnEdit">
                <a id="edit" href="{{route('user-account')}}" aria-label="Edit">Edit</a>
            </div>
        </form>
    </div>

    <div class="archivos">
        <h2>📂 Archivos Subidos</h2>

        @if (isset($files) && isset($invoices))
        @if ($files->isEmpty() && $invoices->isEmpty())
        <p>No tienes archivos ni facturas subidas.</p>
        @else
        <ul>
            @foreach ($files as $file)
            <li>
                <a href="{{ asset('storage/' . $file->file_path) }}" target="_blank">
                    {{ $file->file_name }}
                </a>
            </li>
            @endforeach
        </ul>

        <h2>🧾 Facturas</h2>
        <ul>
            @foreach ($invoices as $invoice)
            <li>
                <a href="{{ asset('storage/' . $invoice->file_path) }}" target="_blank">
                    {{ $invoice->file_name }}
                </a>
            </li>
            @endforeach
        </ul>
        @endif
        @else
        <p>No hay datos disponibles.</p>
        @endif
    </div>


    <x-footer />
    <script src="{{ asset('js/desplegable.js') }}"></script>
</body>

</html>