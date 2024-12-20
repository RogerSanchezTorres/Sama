<div id="sama" style="margin-left: 60px;">
    <div id="logo">
        <a href="{{ route('index') }}"> <img src="{{ asset('img/logo-web-negro.svg') }}" alt="logo"></a>
    </div>
    <div id="buscador">
        <div id="buscador">
            <form action="{{ route('products.buscar') }}" method="GET">
                @csrf
                <button type="button" id="abrirBuscador">
                    <img src="{{ asset('img/lupa.svg') }}" alt="lupa">
                </button>

                <!-- Agrega un cuadro de búsqueda modal oculto -->
                <div id="cuadroBusqueda" class="modal">
                    <div class="modal-contenido">
                        <span id="cerrarBuscador" class="modal-cerrar">&times;</span>
                        <input type="text" id="inputBusqueda" name="termino_busqueda" placeholder="Buscar productos...">
                        <ul id="resultadosBusqueda"></ul>
                    </div>
                </div>
            </form>
        </div>
        @if(auth()->check())
        @if (auth()->user()->role && auth()->user()->role->role === 'admin')
        <div id="usuario">
            <a href="{{ route('admin-view-products') }}"> <img src="{{ asset('img/usuario.svg') }}" alt="usuario"> </a>
        </div>
        @else
        <div id="usuario">
            <a href="{{ route('user-dashboard') }}"> <img src="{{ asset('img/usuario.svg') }}" alt="usuario"> </a>
        </div>
        <div id="carrito">
            <a href="{{ route('cart.show') }}"> <img src="{{ asset('img/carrito-compra.png') }}" alt="carrito de la compra"> </a>
        </div>
        @endif
        @else
        <div id="usuario">
            <a href="{{ route('login') }}"> <img src="{{ asset('img/usuario.svg') }}" alt="usuario"> </a>
        </div>
        <div id="carrito">
            <a href="{{ route('login') }}"> <img src="{{ asset('img/carrito-compra.png') }}" alt="carrito de la compra"> </a>
        </div>
        @endif
    </div>

</div>

<script>
    // Obtener elementos del DOM
    const abrirBuscador = document.getElementById('abrirBuscador');
    const cuadroBusqueda = document.getElementById('cuadroBusqueda');
    const cerrarBuscador = document.getElementById('cerrarBuscador');
    const modal = document.querySelector('.modal'); // Elemento modal

    // Evento para abrir el cuadro de búsqueda
    abrirBuscador.addEventListener('click', () => {
        cuadroBusqueda.style.display = 'block';
    });

    // Evento para cerrar el cuadro de búsqueda al hacer clic en el fondo oscuro
    modal.addEventListener('click', (event) => {
        if (event.target === modal) {
            cuadroBusqueda.style.display = 'none';
        }
    });

    // Evento para cerrar el cuadro de búsqueda al hacer clic en el botón de cerrar
    cerrarBuscador.addEventListener('click', () => {
        cuadroBusqueda.style.display = 'none';
    });

    inputBusqueda.addEventListener('input', () => {
        const terminoBusqueda = inputBusqueda.value.toLowerCase();

        // Realiza una solicitud AJAX al controlador para buscar productos
        fetch(`/buscar-productos?termino_busqueda=${terminoBusqueda}`)
            .then(response => response.json())
            .then(data => {
                const resultados = data.resultados;

                // Limpia resultados anteriores
                resultadosBusqueda.innerHTML = '';

                // Muestra los resultados en la lista
                resultados.forEach(producto => {
                    const li = document.createElement('li');
                    li.textContent = `${producto.nombre_es} - Precio: $${producto.precio_es}`;
                    resultadosBusqueda.appendChild(li);
                });

                // Si no se encontraron resultados, muestra un mensaje
                if (resultados.length === 0) {
                    const mensaje = document.createElement('li');
                    mensaje.textContent = 'No se encontraron resultados para la búsqueda: ' + terminoBusqueda;
                    resultadosBusqueda.appendChild(mensaje);
                }
            });
    });
</script>