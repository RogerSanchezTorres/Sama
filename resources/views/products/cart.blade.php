<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('/style/products/details.css') }}">

</head>

<body>

    <x-header />
    <x-headersama />
    <x-nav />

    <h1>Carrito de Compra</h1>
    @if (count($cart) > 0)
    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cart as $item)
            <tr>
                <td>{{ $item['name'] }}</td>
                <td>{{ $item['price'] }}€</td>
                <td>
                    <a href="{{ route('cart.remove', ['productId' => $item['id']]) }}">Eliminar</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <p>Total: {{ $cartTotal }}€</p>
    <a href="{{ route('cart.checkout') }}">Finalizar Compra</a>
    @else
    <p>El carrito está vacío.</p>
    @endif



    <x-footer />

</body>

</html>