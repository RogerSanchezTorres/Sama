document.addEventListener("DOMContentLoaded", function() {
    const titulosDesplegables = document.querySelectorAll('.desplegable');

    titulosDesplegables.forEach(function(titulo) {
        titulo.addEventListener("click", function() {
            const submenu = titulo.nextElementSibling;
            const estiloSubmenu = window.getComputedStyle(submenu);

            if (estiloSubmenu.display === "block") {
                submenu.style.display = "none";
                titulo.classList.remove("desplegado");
            } else {
                submenu.style.display = "block";
                titulo.classList.add("desplegado");
            }
        });
    });
});
