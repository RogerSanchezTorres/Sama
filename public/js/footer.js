document.addEventListener("DOMContentLoaded", function() {
    const titulosDesplegables = document.querySelectorAll('.desplegable');

    titulosDesplegables.forEach(function(titulo) {
        titulo.addEventListener("click", function() {
            const submenu = titulo.nextElementSibling;

            if (submenu.style.display === "block") {
                submenu.style.display = "none";
                titulo.classList.remove("desplegado");
            } else {
                submenu.style.display = "block";
                titulo.classList.add("desplegado");
            }
        });
    });
});
