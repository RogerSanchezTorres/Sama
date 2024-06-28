<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('img/logos sama/logosama.jpg') }}">
    <title>Pago | {{ config('app.name', 'Laravel') }} </title>
    <script src="https://cdn.tailwindcss.com/3.0.12"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>
    <div class="flex justify-center items-center min-h-screen bg-gray-100">
        <div class="h-auto w-96 bg-white p-6 rounded-lg shadow-lg">
            <p class="text-2xl font-semibold text-center mb-4">Detalles del pago</p>
            <div class="mb-6">
                <label for="customer" class="block text-sm font-medium text-gray-700">Cliente:</label>
                <p id="customer" class="mt-1 text-sm text-gray-900">{{ $user->name }} {{$user->surname}}</p>
            </div>
            <div class="mb-6">
                <label for="description" class="block text-sm font-medium text-gray-700">Descripción:</label>
                <p id="description" class="mt-1 text-sm text-gray-900">{{ $description }}</p>
            </div>
            <div class="mb-6">
                <label for="total" class="block text-sm font-medium text-gray-700">Total a pagar:</label>
                <p id="total" class="mt-1 text-lg font-semibold text-gray-900">{{ $total }}€</p>
            </div>
            <div class="flex justify-center">
                {!! $form !!}
            </div>
            <div class="flex justify-center mt-4">
                <button id="pay" class="inline-block px-6 py-3 text-sm font-semibold text-white bg-blue-500 rounded-lg hover:bg-blue-600 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 transition-all">Pagar</button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Oculta el botón de envío predeterminado del formulario de Redsys
            const redsysForm = document.querySelector('form');
            const redsysSubmitButton = redsysForm.querySelector('input[type="submit"]');
            if (redsysSubmitButton) {
                redsysSubmitButton.style.display = 'none'; // Oculta el botón de envío
            }

            // Añade un evento al botón personalizado para enviar el formulario de Redsys
            const customPayButton = document.getElementById('pay');
            customPayButton.addEventListener('click', function(event) {
                event.preventDefault();
                if (redsysSubmitButton) {
                    redsysSubmitButton.click(); // Simula el clic en el botón de envío oculto
                }
            });
        });
    </script>
</body>

</html>