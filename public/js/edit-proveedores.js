document.addEventListener("DOMContentLoaded", function () {
    const editButton = document.getElementById("edit-mode-button");

    if (editButton) {
        editButton.addEventListener("click", function () {
            let addProveedorForm = document.getElementById("add-proveedor-form");
            let proveedoresContainer = document.getElementById("proveedores");

            // Alternar visibilidad del formulario de añadir proveedor
            if (addProveedorForm) {
                addProveedorForm.style.display = addProveedorForm.style.display === "none" ? "block" : "none";
            }

            // Alternar clase para detener la animación
            if (proveedoresContainer) {
                proveedoresContainer.classList.toggle("editing");
            }

            // Mostrar u ocultar los botones de eliminar
            document.querySelectorAll(".delete-form").forEach(form => {
                form.style.display = form.style.display === "none" ? "block" : "none";
            });
        });
    }
});





document.getElementById("add-proveedor-button").addEventListener("click", function () {
    let fileInput = document.getElementById("new-proveedor-image");
    let file = fileInput.files[0];

    if (!file) {
        alert("Por favor, selecciona una imagen.");
        return;
    }

    let csrfMeta = document.querySelector('meta[name="csrf-token"]');
    if (!csrfMeta) {
        alert("Error: CSRF token no encontrado.");
        return;
    }

    let formData = new FormData();
    formData.append("image", file);

    fetch(uploadProveedorUrl, {
        method: "POST",
        body: formData,
        headers: {
            "X-CSRF-TOKEN": csrfMeta.getAttribute("content"),
        },
    })

        .then(response => response.json())
        .then(data => {
            if (data.success) {
                let imageList = document.getElementById("imagenes");
                let newImage = document.createElement("div");
                newImage.classList.add("proveedor-item");
                newImage.innerHTML = `
    <img src="${data.url}" alt="Nuevo Proveedor" width="120px" height="50px">
    <form action="/proveedores/deleteProveedor/${data.id}" method="POST" class="delete-form" style="display:none;">
        <input type="hidden" name="_token" value="${csrfMeta.getAttribute("content")}">
        <input type="hidden" name="_method" value="DELETE">
        <button type="submit" class="delete-button">Eliminar</button>
    </form>
`;

                imageList.appendChild(newImage);

                fileInput.value = "";
            } else {
                alert("Error al subir la imagen: " + data.message);
            }
        })
        .catch(error => console.error("Error:", error));
});


document.querySelectorAll("#proveedores .delete-form").forEach(form => {
    form.addEventListener("submit", function (event) {
        event.preventDefault(); // Evita la recarga de la página

        let formData = new FormData(this);

        fetch(this.action, {
            method: "POST",
            body: formData,
            headers: {
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
            }
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    let proveedorItem = this.closest(".proveedor-item"); // Solo busca dentro de proveedores

                    if (proveedorItem) {
                        proveedorItem.remove(); // Elimina la imagen de proveedor inmediatamente
                    } else {
                        console.error("❌ No se encontró el elemento proveedor-item");
                    }
                } else {
                    alert("Error: " + data.message);
                }
            })
            .catch(error => console.error("Error en la petición:", error));
    });
});











