document.addEventListener('DOMContentLoaded', () => {
    const el = document.getElementById('image-list');
    if (el) {
        new Sortable(el, {
            animation: 150,
            onEnd: function (evt) {
                const order = Array.from(document.querySelectorAll('.image-item')).map(item => item.dataset.id);

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
                        console.log(data.message);
                    } else {
                        console.error("Error al actualizar el orden:", data.message);
                    }
                })
                .catch(error => console.error("Error en la petición:", error));
            }
        });
    }
});
