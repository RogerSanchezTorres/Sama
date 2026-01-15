<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Pedido confirmado</title>
</head>

<body style="font-family: Arial, sans-serif; background-color: #f6f6f6; padding: 30px;">

    <div style="max-width: 600px; margin: auto; background: #ffffff; padding: 30px;">

        <div style="text-align: center; margin-bottom: 20px;">
            <img src="{{ asset('images/logo.png') }}" alt="Suministres Sama" style="max-width: 200px;">
        </div>

        <h2 style="color: #000;">Pedido confirmado</h2>

        <p>Hola <strong>{{ $order->user_name }}</strong>,</p>

        <p>
            Hemos recibido correctamente tu pedido.
            En breve comenzaremos a procesarlo.
        </p>

        <hr>

        <p><strong>Número de pedido:</strong> #{{ $order->id }}</p>
        <p><strong>Total:</strong> {{ number_format($order->total, 2) }} €</p>

        <hr>

        <p style="margin-top: 20px;">
            Gracias por confiar en <strong>Suministres Sama</strong>.
        </p>

        <p style="font-size: 13px; color: #777;">
            Este correo es una confirmación automática, por favor no respondas.
        </p>

    </div>
</body>

</html>