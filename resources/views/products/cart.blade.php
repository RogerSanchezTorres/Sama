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
                    <form class="update-quantity-form" data-product-id="{{ $item->product->id }}">
                        @csrf
                        <label for="quantity">Cantidad:</label>
                        <input class="quantity-input" type="number" name="quantity" value="{{ $item->quantity }}" min="1">
                    </form>
                </td>
                <td class="total-price">{{ $item->quantity * $item->product->precio_es }}€</td>
                <td class="actions">
                    <a href="{{ route('cart.remove', ['productId' => $item['id']]) }}" onclick="return confirm('¿Estás seguro?')">Eliminar</a>
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
            // Recupera la información del carrito de cookies al cargar la página
            var cart = JSON.parse(getCookie('cart')) || {};

            // Actualiza los inputs de cantidad con los valores almacenados
            Object.keys(cart).forEach(function(productId) {
                var input = document.querySelector('.quantity-input[data-product-id="' + productId + '"]');
                if (input) {
                    input.value = cart[productId];
                    updateTotalPrice(input);
                }
            });

            // Actualiza dinámicamente el precio total por ítem cuando se cambia la cantidad
            document.querySelectorAll('.quantity-input').forEach(function(input) {
                input.addEventListener('input', function() {
                    updateTotalPrice(input);
                    updateCartTotal();

                    // Actualiza la información del carrito en cookies
                    var productId = input.getAttribute('data-product-id');
                    cart[productId] = parseFloat(input.value);
                    setCookie('cart', JSON.stringify(cart), 365); // Caducidad de la cookie en días
                });
            });

            // Función para actualizar el precio total
            function updateTotalPrice(input) {
                var row = input.closest('.cart-item');
                var unitPrice = parseFloat(row.querySelector('.unit-price').textContent);
                var quantity = parseFloat(input.value);
                var totalPriceElement = row.querySelector('.total-price');
                var newTotalPrice = (unitPrice * quantity).toFixed(2);
                totalPriceElement.textContent = newTotalPrice + '€';
            }

            // Función para actualizar el total del carrito
            function updateCartTotal() {
                var cartTotalElement = document.getElementById('cart-total');
                var cartTotal = 0;

                // Suma los precios totales de cada ítem en el carrito
                document.querySelectorAll('.total-price').forEach(function(totalPriceElement) {
                    cartTotal += parseFloat(totalPriceElement.textContent);
                });

                cartTotalElement.textContent = cartTotal.toFixed(2) + '€';
            }

            // Función para obtener el valor de una cookie
            function getCookie(name) {
                var value = "; " + document.cookie;
                var parts = value.split("; " + name + "=");
                if (parts.length === 2) return parts.pop().split(";").shift();
            }

            // Función para establecer el valor de una cookie
            function setCookie(name, value, days) {
                var expires = "";
                if (days) {
                    var date = new Date();
                    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                    expires = "; expires=" + date.toUTCString();
                }
                document.cookie = name + "=" + value + expires + "; path=/";
            }
        });
    </script>

</body>

</html>