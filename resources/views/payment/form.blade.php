<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Form</title>
</head>

<body>
    <div class="container">
        <h1>Checkout</h1>
        <div class="payment-form">
            <p>Precio Total: {{ $cartTotal }}€</p>

            <form method="GET" action="{{ url('/paypal/pay') }}">
                @csrf
                <div class="form-group">
                    <label for="card_number">Número de Tarjeta:</label>
                    <input type="text" name="card_number" id="card_number" required>
                </div>
                <div class="form-group">
                    <label for="expiration_date">Fecha de Expiración:</label>
                    <input type="text" name="expiration_date" id="expiration_date" placeholder="MM/YYYY" required>
                </div>
                <!--<div class="form-group">
                    <label for="cvv">CVV:</label>
                    <input type="text" name="cvv" id="cvv" required>
                </div>-->
                <button type="submit">Pagar Ahora</button>
            </form>
        </div>
    </div>
</body>

</html>