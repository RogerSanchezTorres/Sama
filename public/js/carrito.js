document.addEventListener('DOMContentLoaded', function () {
    const addToCartButtons = document.querySelectorAll('.add-to-cart-button');

    addToCartButtons.forEach(button => {
        button.addEventListener('click', () => {
            const productId = button.getAttribute('data-product-id');
            addToCart(productId);
        });
    });

    function addToCart(productId) {
        // Realiza una solicitud AJAX para agregar el producto al carrito
        fetch(`/cart/add/${productId}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            },
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Producto agregado al carrito con éxito.');
                } else {
                    alert('No se pudo agregar el producto al carrito.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }
});