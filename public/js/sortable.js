document.addEventListener('DOMContentLoaded', () => {
    const sortable = new Sortable(document.getElementById('image-list'), {
        animation: 150, // Animación al mover elementos
        onEnd: function (evt) {
            // Obtener el nuevo orden de las imágenes
            const order = Array.from(document.querySelectorAll('.image-item')).map(item => item.dataset.id);
            console.log(order); // Verifica si el orden se genera correctamente

            // Realizar la petición para actualizar el orden
            fetch(updateOrderUrl, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": csrfToken
                },
                body: JSON.stringify({ order })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log(data.message); // Confirmar éxito
                    } else {
                        console.error("Error al actualizar el orden:", data.message);
                    }
                })
                .catch(error => console.error("Error en la petición:", error));
        }
    });
});
