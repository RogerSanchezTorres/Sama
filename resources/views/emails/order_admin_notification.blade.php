<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Pedido Recibido</title>
</head>

<body>

    <h2>Nuevo pedido recibido</h2>

    <p><strong>Pedido:</strong> #{{ $order->id }}</p>
    <p><strong>Cliente:</strong> {{ $order->user_name }}</p>
    <p><strong>Total:</strong> {{ number_format($order->total, 2) }} €</p>

    <hr>

    <h3>Productos:</h3>

    <table width="100%" border="1" cellpadding="6" cellspacing="0">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
            <tr>
                <td>{{ $item->product->nombre_es }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ number_format($item->price, 2) }} €</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>