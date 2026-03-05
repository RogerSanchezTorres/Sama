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

        <table width="100%" cellpadding="8" cellspacing="0" border="1" style="border-collapse: collapse;">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->products as $product)
                <tr>
                    <td>{{ $product->nombre_es }}</td>
                    <td>{{ $product->pivot->quantity }}</td>
                    <td>{{ number_format($product->pivot->price, 2) }} €</td>
                    <td>
                        {{ number_format($product->pivot->price * $product->pivot->quantity, 2) }} €
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

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