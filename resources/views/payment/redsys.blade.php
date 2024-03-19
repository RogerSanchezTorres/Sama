<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pago</title>

    <script src="https://cdn.tailwindcss.com/3.0.12"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div class="flex justify-center items-center min-h-screen bg-blue-300">
        <div class="h-auto w-80 bg-white p-3 rounded-lg">
            <p class="text-xl font-semibold">Detalles del pago</p>
            <div class="input_text mt-6 relative">
                <span class="absolute left-0 text-sm -top-4 text-blue-600">Cliente</span>
                <p>{{ $user->name }}</p>
            </div>
            <div class="input_text mt-8 relative">
                <span class="absolute left-0 text-sm -top-4 text-blue-600">Descripción</span>
                <p>{{ $description }}</p>
            </div>

            <p class="text-lg text-left mt-4 text-gray-600 font-semibold">Total a pagar: {{ $total }}€</p>
            <div class="flex justify-center mt-4">
                <button id="pay" class="outline-none pay h-12 bg-orange-600 text-white mb-3 hover:bg-orange-700 rounded-lg w-1/2 cursor-pointer transition-all">Pagar</button>
                {!! $form !!}
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const payButton = document.getElementById('pay');
            const formButton = document.getElementById('btn_id');

            payButton.addEventListener('click', function(event) {
                event.preventDefault();
                formButton.click();
            });
        });
    </script>
</body>

</html>