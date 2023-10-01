<footer id="footer">
    <div id="info-footer">
        <div class="nosotros">
            <p class="titulo">Sobre nosotros</p>
            <div id="info">
                <a href="{{ route('quienes-somos') }}">Quiénes Somos</a>
                <a href="{{ route('aviso-legal') }}">Aviso legal</a>
                <a href="{{ route('cookies') }}">Política de Cookies</a>
                <a href="{{ route('privacidad') }}">Políticas de Privacidad y RGPD</a>
            </div>
        </div>
        <div class="categorias">
            <p class="titulo">Categorias</p>
            @foreach(\App\Models\MainCategory::all() as $mainCategory)
            <div id="info">
                <a href="{{ route('products.showByMainCategory', ['mainCategoryId' => $mainCategory->id]) }}">{{ $mainCategory->nombre }}</a>
            </div>
            @endforeach
        </div>
        <div class="contacto">
            <p class="titulo">Contacto</p>
            <div id="info">
                <p class="nombre">Subministres Sama</p>
                <div class="ubicacion">
                    <img src="{{ asset('img/ubicacion.svg') }}" alt="ubicacion">
                    <div id="info-ubicacion">
                        <p>Castelldefels</p>
                        <p>Avinguda de la Constitució 77-79</p>
                        <p>Begues</p>
                        <p>Carrer Sant Oreste, 33</p>
                    </div>
                </div>
                <div class="telefono">
                    <img src="{{ asset('img/telefono.svg') }}" alt="telefono">
                    <div class="castelldefels">
                        <a href="tel:+34931050559">Castelldefels 931 050 559 /</a>
                    </div>
                    <div class="begues">
                        <a href="tel:+34936551245">Begues 936 551 245</a>
                    </div>
                </div>
                <div class="correo">
                    <img src="{{ asset('img/correo.svg') }}" alt="correo">
                    <a href="mailto:info@subministressama.es">info@subministressama.es</a>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-empresa">
        <div class="empresa">
            <p>© Subministres Sama 2022</p>
            <div class="redes">
                <div id="facebook">
                    <a href="https://www.facebook.com/SUBMINISTRESSAMA/"><img src="{{ asset('img/facebook.svg') }}" alt="facebook"></a>
                </div>
                <div id="twitter">
                    <a href="#"><img src="{{ asset('img/twitter.svg') }}" alt="twitter"></a>
                </div>
                <div id="instagram">
                    <a href="https://www.instagram.com/subministressama/?hl=es&__coig_restricted=1"><img src="{{ asset('img/instagram.svg') }}" alt="instagram"></a>
                </div>
            </div>
        </div>

    </div>

</footer>