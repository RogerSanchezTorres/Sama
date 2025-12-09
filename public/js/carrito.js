document.addEventListener('DOMContentLoaded', function () {
    const comprarButtons = document.querySelectorAll('.comprar-btn');

    comprarButtons.forEach(button => {
        button.addEventListener('click', function () {
            const productId = button.getAttribute('data-product-id');

            fetch(`/cart/add/${productId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json'
                }
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        updateCartCount(data.cart_count);
                    } else {
                        alert('No se pudo agregar el producto al carrito.');
                    }
                })
                .catch(error => console.error('Error:', error));
        });
    });
});

// ➤ FUNCION PARA ACTUALIZAR EL CONTADOR GLOBAL DEL CARRITO
function updateCartCount(count) {
    const cartCountEl = document.getElementById('cart-count');
    if (cartCountEl) {
        cartCountEl.textContent = count;
    }
}

