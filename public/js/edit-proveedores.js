document.getElementById("edit-mode-button").addEventListener("click", function () {
    const imagenesContainer = document.getElementById("imagenes");
    imagenesContainer.classList.toggle("edit-mode");
    const isEditMode = imagenesContainer.classList.contains("edit-mode");

    // Mostrar/ocultar botones de eliminación y el formulario de añadir
    document.querySelectorAll(".delete-proveedor-button").forEach(button => {
        button.style.display = isEditMode ? 'inline' : 'none';
    });
    document.getElementById("add-proveedor-form").style.display = isEditMode ? 'block' : 'none';
});



// Evento para añadir una nueva imagen de proveedor
document.getElementById("add-proveedor-button").addEventListener("click", function () {
    const fileInput = document.getElementById("new-proveedor-image");

    if (fileInput.files.length === 0) {
        alert("Por favor, selecciona una imagen.");
        return;
    }

    const formData = new FormData();
    formData.append("file", fileInput.files[0]);  // El nombre debe ser "file" para coincidir con el controlador

    fetch(addProveedorRoute, {  // Usar la variable de ruta
        method: "POST",
        body: formData,
        headers: {
            "X-CSRF-TOKEN": csrfToken
        }
    })
        .then(response => response.json())
        .then(data => {
            if (data.path) {
                // Añadir la nueva imagen al DOM
                const newProveedor = document.createElement("div");
                newProveedor.className = "proveedor-item";
                newProveedor.setAttribute("data-path", data.path);
                newProveedor.innerHTML = `<img src="${data.path}" alt="Logo del proveedor" width="120px" height="50px">
                <button class="delete-proveedor-button" style="display:inline;">Eliminar</button>
                `;
                document.getElementById("imagenes").appendChild(newProveedor);
                fileInput.value = '';  // Limpiar el campo de archivo
            } else {
                console.error("Error al añadir la imagen:", data.error || "Error desconocido.");
            }
        })
        .catch(error => console.error("Error en la petición:", error));
});

// Evento para eliminar una imagen de proveedor
document.addEventListener("click", function (event) {
    if (event.target.classList.contains("delete-proveedor-button")) {
        const proveedorItem = event.target.closest(".proveedor-item");
        const path = proveedorItem.getAttribute("data-path");

        fetch(deleteProveedorRoute, {  // Usar la variable de ruta
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": csrfToken
            },
            body: JSON.stringify({ path: path })
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Eliminar el elemento del DOM
                    proveedorItem.remove();
                } else {
                    console.error("Error al eliminar la imagen");
                }
            })
            .catch(error => console.error("Error en la petición:", error));
    }
});
