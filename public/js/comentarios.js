function openTab(tabName) {
    var i, tabContent, tabLinks;

    // Ocultar todos los elementos de contenido
    tabContent = document.getElementsByClassName("tab-content");
    for (i = 0; i < tabContent.length; i++) {
        tabContent[i].style.display = "none";
    }

    // Desactivar todas las clases "active" en las pestañas
    tabLinks = document.getElementsByClassName("tab");
    for (i = 0; i < tabLinks.length; i++) {
        tabLinks[i].classList.remove("active");
    }

    // Mostrar el contenido de la pestaña seleccionada
    document.getElementById(tabName).style.display = "block";

    // Agregar la clase "active" a la pestaña actual
    event.currentTarget.classList.add("active");
}