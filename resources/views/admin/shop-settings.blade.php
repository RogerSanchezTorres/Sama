<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('img/logos sama/logosama.jpg') }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/style/admin/admin-shop.css') }}">
</head>

<body>
    <x-header />
    <x-headersama />
    <x-nav />
    <x-header-admin />

    <div class="container">
        <h2 class="mb-4">Estado de la tienda</h2>

        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <div class="card">
            <div class="card-body">
                <p class="mb-3">
                    Estado actual:
                    <strong class="{{ $enabled ? 'text-success' : 'text-danger' }}">
                        {{ $enabled ? 'TIENDA ACTIVA' : 'MODO CATÁLOGO' }}
                    </strong>
                </p><br>

                <form method="POST" action="{{ route('admin.shop.toggle') }}">
                    @csrf
                    <button class="btn {{ $enabled ? 'btn-danger' : 'btn-success' }}">
                        {{ $enabled ? 'Desactivar tienda' : 'Activar tienda' }}
                    </button>
                </form><br>
            </div>
        </div>

        <form id="bannerForm" method="POST" action="{{ route('admin.shop.banner') }}" class="banner-form">
            @csrf

            <input type="hidden" name="banner_enabled" value="0">

            <label class="checkbox-label">
                <input type="checkbox" id="banner_enabled" name="banner_enabled" value="1" {{ $bannerEnabled ? 'checked' : '' }}>

                Activar banner
            </label>

            <label>Título del banner</label>

            <input id="bannerTitle" type="text" name="banner_title" value="{{ old('banner_title', App\Models\Setting::bannerTitle()) }}" maxlength="60">
            <div>
                <label>Texto del banner</label>

                <textarea id="bannerText" name="banner_text">{{ old('banner_text',$bannerText) }}</textarea>
            </div>

            <div class="banner-row">

                <div>
                    <label>Color</label>

                    <select id="bannerColor" name="banner_color">
                        <option value="warning">Amarillo</option>
                        <option value="danger">Rojo</option>
                        <option value="success">Verde</option>
                        <option value="info">Azul</option>
                    </select>
                </div>

                <div>
                    <label>Mostrar desde</label>

                    <input type="date"
                        name="banner_start"
                        value="{{ $bannerStart }}">
                </div>

                <div>
                    <label>Mostrar hasta</label>

                    <input type="date"
                        name="banner_end"
                        value="{{ $bannerEnd }}">
                </div>

            </div>

            <button class="btn btn-success">
                Guardar banner
            </button>

            <div id="preview"
                class="banner-preview {{ $bannerColor }}">
                {{ $bannerText ?: 'Aquí aparecerá la vista previa del banner.' }}
            </div>

        </form>

        @if(!$enabled)
        <div class="alert alert-info mt-4">
            La web se muestra como catálogo. Los precios y la compra están deshabilitados.
        </div>
        @endif
    </div>

    <x-footer />

    <script src="{{ asset('js/desplegable.js') }}"></script>
</body>

</html>