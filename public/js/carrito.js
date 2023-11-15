document.addEventListener('DOMContentLoaded', function () {
    const comprarButtons = document.querySelectorAll('.comprar-btn');

    comprarButtons.forEach(button => {
        button.addEventListener('click', function () {
            const productId = button.getAttribute('data-product-id');

            fetch(`/cart/add/${productId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Producto agregado al carrito con éxito.');
                    updateUI(data.product);
                } else {
                    alert('No se pudo agregar el producto al carrito.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    });
});
