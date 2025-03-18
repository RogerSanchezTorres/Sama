<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('img/logos sama/logosama.jpg') }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('/style/admin/upload.css') }}">
</head>

<body>
    <x-header />
    <x-headersama />
    <x-nav />
    <x-header-admin />

    <div class="content">
        <div class="upload-container">
            <h2>📤 Subir contenido a un usuario</h2>
            <form action="{{ route('admin.uploadContent') }}" method="POST" enctype="multipart/form-data" class="upload-form">
                @csrf
                <div class="form-group">
                    <label for="user_id">👤 Seleccionar usuario:</label>
                    <select name="user_id" id="user_id" class="form-control">
                        @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }} {{ $user->surname }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="file">📎 Subir archivo:</label>
                    <input type="file" name="file" id="file" class="form-control">
                </div>

                <button type="submit" class="btn-submit">📂 Subir Archivo</button>
            </form>
        </div>

        <div class="upload-container">
            <h2>🧾 Subir Factura</h2>
            <form action="{{ route('admin.uploadInvoice') }}" method="POST" enctype="multipart/form-data" class="upload-form">
                @csrf
                <div class="form-group">
                    <label for="user_id_invoice">👤 Seleccionar usuario:</label>
                    <select name="user_id" id="user_id_invoice" class="form-control">
                        @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }} {{ $user->surname }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="invoice">📎 Subir factura:</label>
                    <input type="file" name="file" id="invoice" class="form-control">
                </div>

                <button type="submit" class="btn-submit invoice-btn">🧾 Subir Factura</button>
            </form>
        </div>

    </div>



    <x-footer />

    <script src="{{ asset('js/desplegable.js') }}"></script>
</body>

</html>