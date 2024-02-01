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
    <div class="cart-container">
    
        @if ($cart->count() > 0)
        <div class="cart-items">
            @foreach ($cart as $item)
            <div class="cart-item" data-product-id="{{ $item->product->id }}">
                <div class="item-image">
                    <img src="{{ asset($item->product->img) }}" alt="{{ $item->product->nombre_es }}">
                </div>
                <div class="item-details">
                    <h3 class="item-name">{{ $item->product->nombre_es }}</h3>
                    <p class="item-unit-price">{{ $item->quantity * $item->product->precio_es }}€</p>
                </div>
                <div class="item-quantity">
                    <form id="updateQuantityForm" action="{{ route('cart.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="cart[{{ $item->product_id }}][quantity]" value="{{ $item->quantity }}">
                        <label for="quantity_{{ $item->product_id }}">Cantidad:</label>
                        <input type="number" name="cart[{{ $item->product_id }}][quantity]" id="quantity_{{ $item->product_id }}" value="{{ $item->quantity }}" min="1" class="quantity-input">
                    </form>
                </div>
                <div class="item-actions">
                    <a href="{{ route('cart.remove', ['productId' => $item->product_id]) }}" onclick="return confirm('¿Estás seguro?')">Eliminar</a>
                </div>
            </div>
            @endforeach
        </div>

        <div class="cart-summary">
            <p class="total">Total: <span id="cart-total">{{ $cartTotal }}</span>€</p>
            <div class="actions">
                <a href="{{ route('cart.checkout') }}">Realizar Compra</a>
            </div>
        </div>
        @else
        <p class="empty">El carrito está vacío.</p>
        @endif
    </div>

    <x-footer />
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.quantity-input').forEach(function(input) {
                input.addEventListener('input', function() {
                    updateTotalPrice(input);
                    updateDatabase();
                    updateQuantityForm(input);
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
            var form = input.closest('form');
            form.submit();
        }

        window.addEventListener('beforeunload', function() {
            updateDatabase();
        });
    </script>

</body>

</html>