const elementosLista = document.querySelectorAll("#navegador li");

elementosLista.forEach(function(elemento) {
  elemento.addEventListener("mouseover", function() {
    const submenu = this.querySelector("ul");
    if (submenu) {
      submenu.style.display = "block";
    }
  });

  elemento.addEventListener("mouseout", function() {
    const submenu = this.querySelector("ul");
    if (submenu) {
      submenu.style.display = "none";
    }
  });
});
