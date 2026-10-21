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

document.addEventListener('DOMContentLoaded', function () {
  const input = document.getElementById('productImages');
  const preview = document.getElementById('newImagesPreview');

  if (!input || !preview) return;

  let objectUrls = [];

  input.addEventListener('change', function () {
    objectUrls.forEach(url => URL.revokeObjectURL(url));
    objectUrls = [];
    preview.replaceChildren();

    Array.from(input.files).forEach(function (file, index) {
      if (!file.type.startsWith('image/')) return;

      const card = document.createElement('div');
      card.className = 'product-image-card';

      const frame = document.createElement('div');
      frame.className = 'product-image-frame';

      const image = document.createElement('img');
      const url = URL.createObjectURL(file);

      objectUrls.push(url);
      image.src = url;
      image.alt = 'Vista previa de ' + file.name;

      const footer = document.createElement('div');
      footer.className = 'product-image-footer';

      const name = document.createElement('span');
      name.className = 'image-name';
      name.textContent = file.name;

      frame.appendChild(image);
      footer.appendChild(name);
      card.appendChild(frame);
      card.appendChild(footer);
      preview.appendChild(card);
    });
  });
});
