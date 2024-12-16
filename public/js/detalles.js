document.getElementById('add-detalle').addEventListener('click', function () {
    const container = document.getElementById('detalles-container');
    const input = document.createElement('input');
    input.type = 'text';
    input.name = 'detalles_lista[]';
    input.classList.add('form-control', 'mb-2');
    container.appendChild(input);
});
