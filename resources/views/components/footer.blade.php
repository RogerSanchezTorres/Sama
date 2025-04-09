<footer id="footer">
    <div id="info-footer">
        <div class="nosotros" data-toggle="submenu">
            <p class="titulo desplegable">Sobre nosotros</p>
            <div id="info" class="nav-submenu">
                <a href="{{ route('quienes-somos') }}">Quiénes Somos</a>
                <a href="{{ route('aviso-legal') }}">Aviso legal</a>
                <a href="{{ route('cookies') }}">Política de Cookies</a>
                <a href="{{ route('privacidad') }}">Políticas de Privacidad y RGPD</a>
            </div>
        </div>
        <div class="categorias" data-toggle="submenu">
            <p class="titulo desplegable">Categorias</p>
            @foreach(\App\Models\MainCategory::all() as $mainCategory)
            <div id="info" class="nav-submenu">
                <a href="{{ route('products.showByMainCategory', ['mainCategoryId' => $mainCategory->id]) }}">{{ $mainCategory->nombre }}</a>
            </div>
            @endforeach
        </div>
        <div class="contacto" data-toggle="submenu">
            <p class="titulo desplegable">Contacto</p>
            <div id="info" class="nav-submenu">
                <p class="nombre">Subministres Sama</p>
                <div class="ubicacion">
                    <img src="{{ asset('img/ubicacion.svg') }}" alt="ubicacion" width="20px">
                    <div id="info-ubicacion">
                        <p>Castelldefels</p>
                        <p>Avinguda de la Constitució 77-79</p>
                    </div>
                </div>
                <div class="telefono">
                    <img src="{{ asset('img/telefono.svg') }}" alt="telefono" width="15px">
                    <div class="castelldefels">
                        <a href="tel:+34931050559">Castelldefels 931 050 559 /</a>
                    </div>
                </div>
                <div class="correo">
                    <img src="{{ asset('img/correo.svg') }}" alt="correo" width="15px">
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
