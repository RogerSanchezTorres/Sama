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

    <div class="container">
        <h1>Usuarios Pendientes de Aprobación</h1>

        @if ($users->isEmpty())
        <p>No hay usuarios pendientes de aprobación en este momento.</p>
        @else
        <div class="row">
            @foreach ($users as $user)
            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">{{ $user->name }} {{ $user->surname }}</h5>
                        <p class="card-text">Correo Electrónico: {{ $user->email }}</p>
                        <p class="card-text">Teléfono: {{ $user->phoneNumber }}</p>

                        <form action="{{ route('admin.approveUser', ['user' => $user->id]) }}" method="POST">
                            @csrf
                            @method('PATCH')

                            <div class="form-group">
                                <label for="role">Rol:</label>
                                <select name="role" id="role" class="form-control">
                                    <option value="admin">Admin</option>
                                    <option value="profesional">Profesional</option>
                                    <option value="particular">Particular</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Aprobar Usuario</button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>


    <x-footer />
</body>

</html>