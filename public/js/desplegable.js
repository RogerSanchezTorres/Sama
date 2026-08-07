const elementosLista = document.querySelectorAll("#navegador li");

elementosLista.forEach(function (elemento) {
  elemento.addEventListener("mouseover", function () {
    const submenu = this.querySelector("ul");
    if (submenu) {
      submenu.style.display = "block";
    }
  });

  elemento.addEventListener("mouseout", function () {
    const submenu = this.querySelector("ul");
    if (submenu) {
      submenu.style.display = "none";
    }
  });
});

document.addEventListener('DOMContentLoaded', function () {

  const texto = document.querySelector('textarea[name="banner_text"]');
  const color = document.querySelector('select[name="banner_color"]');
  const preview = document.querySelector('.banner-preview');

  function actualizarPreview() {

    preview.textContent = texto.value.trim() !== ''
      ? texto.value
      : 'Aquí aparecerá la vista previa del banner.';

    preview.classList.remove('warning', 'danger', 'success', 'info');
    preview.classList.add(color.value);
  }

  texto.addEventListener('input', actualizarPreview);
  color.addEventListener('change', actualizarPreview);

  actualizarPreview();

});

document.getElementById('banner_enabled').addEventListener('change', function () {
  document.getElementById('bannerForm').submit();
});
