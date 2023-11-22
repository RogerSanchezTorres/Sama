<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('/style/products/cart.css') }}">

</head>

<body>

    <x-header />
    <x-headersama />
    <x-nav />

    <h1>Carrito de Compra</h1>
    @if ($cart->count() > 0)
    <table id="cart">
        <thead>
            <tr>
                <th></th>
                <th>Producto</th>
                <th>Precio Unitario</th>
                <th>Cantidad</th>
                <th>Precio Total</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cart as $item)
            <tr class="cart-item" data-product-id="{{ $item->product->id }}">
                <td><img src="{{ asset($item->product->img) }}" alt="{{ $item->product->nombre_es }}"></td>
                <td class="name">{{ $item->product->nombre_es }}</td>
                <td class="unit-price">{{ $item->product->precio_es }}€</td>
                <td class="quantity">
                    <form id="updateQuantityForm" action="{{ route('cart.update') }}" method="POST">
                        @csrf
                        <div class="cart-item">
                            <input type="hidden" name="cart[{{ $item->product_id }}][quantity]" value="{{ $item->quantity }}">

                            <label for="quantity_{{ $item->product_id }}">Cantidad:</label>
                            <input type="number" name="cart[{{ $item->product_id }}][quantity]" id="quantity_{{ $item->product_id }}" value="{{ $item->quantity }}" min="1" class="quantity-input">
                        </div>
                    </form>
                </td>
                <td class="total-price">{{ $item->quantity * $item->product->precio_es }}€</td>
                <td class="actions">
                    <a href="{{ route('cart.remove', ['productId' => $item->product_id]) }}" onclick="return confirm('¿Estás seguro?')">Eliminar</a>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <p class="total">Total: <span id="cart-total">{{ $cartTotal }}</span>€</p>
    <div class="actions">
        <a href="{{ route('cart.checkout') }}">Finalizar Compra</a>
    </div>
    @else
    <p class="empty">El carrito está vacío.</p>
    @endif

    <x-footer />
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.quantity-input').forEach(function(input) {
                input.addEventListener('input', function() {
                    updateTotalPrice(input);
                    updateDatabase();
                    updateQuantityForm(input); // Ahora pasamos el input actual como parámetro
                });
            });
        });

        function updateTotalPrice(input) {
            // ... (resto de la función permanece igual)
        }

        function updateDatabase() {
            // ... (resto de la función permanece igual)
        }

        function updateQuantityForm(input) {
            var form = input.closest('form'); // Encontramos el formulario más cercano al input actual
            form.submit();
        }

        window.addEventListener('beforeunload', function() {
            updateDatabase();
        });
    </script>

</body>

</html>