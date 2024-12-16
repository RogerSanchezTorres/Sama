document.getElementById("edit-mode-button").addEventListener("click", function () {
    const imagenesContainer = document.getElementById("imagenes");
    imagenesContainer.classList.toggle("edit-mode");
    const isEditMode = imagenesContainer.classList.contains("edit-mode");

    // Mostrar/ocultar formularios de eliminación
    document.querySelectorAll(".delete-form").forEach(form => {
        form.style.display = isEditMode ? 'inline' : 'none';
    });
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

document.addEventListener("submit", function (event) {
    if (event.target.classList.contains("delete-form")) {
        event.preventDefault(); // Detenemos el envío por defecto para mostrar la confirmación

        const confirmDelete = confirm("¿Estás seguro de que deseas eliminar este proveedor?");
        if (confirmDelete) {
            event.target.submit(); // Envía el formulario si se confirma
        }
    }
});
