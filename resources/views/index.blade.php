<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="{{ asset('img/logos sama/logosama.jpg') }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('style/index.css') }}">
</head>

<body>
    <x-header />
    <x-headersama />

    <x-nav />

    @if (auth()->check() && auth()->user()->role && auth()->user()->role->role === 'admin')
    <button id="edit-button">Modo Edición</button>
    @endif


    <div id="image-list" class="img-info">
        <!-- Las imágenes desde la base de datos -->
        @foreach($images as $image)
        <div class="image-item" data-id="{{ $image->id }}">
            <div class="border"></div>
            <img src="{{ asset($image->path) }}" alt="Imagen" class="image" style=" max-width: 383px; height: 215px; margin: 10px;">
            <form action="{{ route('images.destroy', $image->id) }}" method="POST" class="delete-form" style="display:none;">
                @csrf
                @method('DELETE')
                <button type="submit" class="delete-button">Eliminar</button>
            </form>
        </div>
        @endforeach
    </div>


    <!-- Formulario para añadir imágenes -->
    <div id="add-image-form" style="display:none;">
        <h3>Añadir Nueva Imagen</h3>
        <input type="file" id="new-image-file" accept="image/*">
        <button id="add-image-button">Añadir Imagen</button>
    </div>



    @if (auth()->check() && auth()->user()->role && auth()->user()->role->role === 'admin')
    <button id="edit-mode-button" style="display: block;">Modo Edición</button>
    @endif

    <div id="proveedores">
        <div id="imagenes">
            @foreach ($proveedores as $proveedor)
            <div class="proveedor-item" data-path="{{ $proveedor->path }}">
                <img src="{{ asset($proveedor->path) }}" alt="Logo del proveedor" width="120px" height="50px">
                <form action="{{ route('proveedores.deleteProveedor', $proveedor->id) }}" method="POST" class="delete-form" style="display:none;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete-button">Eliminar</button>
                </form>
            </div>
            @endforeach



            <img src=" {{ asset('img/logos proveedores/3i_logo.png') }} " alt="3i logo" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/Alsimet_logo.png') }} " alt="Alsimet logo" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/azuliber.png') }} " alt="azuliber logo" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/basor.png') }} " alt="basor logo" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/bayrol_logo.jpg') }} " alt="bayrol logo" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/benadresa.png') }} " alt="benadresa logo" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/braseli.png') }} " alt="braseli logo" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/calpeda_logo.JPG') }} " alt="calpeda logo" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/Cemex-logo.jpg') }} " alt="cemex logo" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/Ceys.jpg') }} " alt="ceys logo" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/dake-cocinas.jpg') }} " alt="dake cocinas logo" width="120px" height="70px">
            <img src=" {{ asset('img/logos proveedores/DUNE_logo.png') }} " alt="dune logo" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/fermax.png') }} " alt="fermax logo" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/gme_logo.gif') }} " alt="gme logo" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/honeywell_logo_720x176.jpg') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/ílogo-dunlop.png') }} " alt="ílogo dunlop logo" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/log-prhie.png') }} " alt="prhie logo" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo caleffi.png') }} " alt="caleffi logo" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/Logo FAMATEL.png') }} " alt="famatel logo" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo plaza.jpg') }} " alt="plaza logo" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_adequa.jpg') }} " alt="adequa logo" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_ariston.png') }} " alt="ariston logo" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_askoll.png') }} " alt="askoll logo" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_azuliber.jpg') }} " alt="azuliber logo" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_broquetas.jpg') }} " alt="broquetas logo" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_celesa.jpg') }} " alt="celesa logo" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_ceramicaferres.jpg') }} " alt="ceramica ferres logo" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_ceramicasbelianes.jpg') }} " alt="ceramicas belianes logo" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_cointra.jpg') }} " alt="cointra logo" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_comersin.png') }} " alt="comersin logo" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_crearplast.jpg') }} " alt="crearplast logo" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_dajusa.jpg') }} " alt="dajsua logo" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_dakota.jpg') }} " alt="dakota logo" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_dismol.jpg') }} " alt="dismol logo" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_efapel.jpg') }} " alt="efapel logo" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_emmeti.png') }} " alt="emmeti logo" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_eskubi.png') }} " alt="eskubi logo" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_exagres.png') }} " alt="exagres logo" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_ferroli.png') }} " alt="ferroli logo" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_fig.jpg') }} " alt="fig logo" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_firstiberica.jpg') }} " alt="first iberica logo" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_fredimar.jpg') }} " alt="fredimar logo" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_adequa.jpg') }} " alt="adequa logo" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_fujitsu.png') }} " alt="fujitsu logo" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_geminis.jpg') }} " alt="geminis logo" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_genwec.jpg') }} " alt="genwec logo" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/LOGO_GISCOSA.png') }} " alt="giscosa logo" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/Logo_Henkel.jpg') }} " alt="hankel logo" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_hiyasu.jpg') }} " alt="hiyasu logo" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_inelca.jpg') }} " alt="inelca logo" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_isopipe.jpg') }} " alt="isopipe logo" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_jimten.png') }} " alt="jimten logo" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_kapataz.png') }} " alt="kepataz logo" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_laes.png') }} " alt="laes logo" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_mapei.jpg') }} " alt="mapei logo" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_mediterraneadelbaño.jpg') }} " alt="mediterranea del baño logo" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_mundilite.JPG') }} " alt="mundilite logo" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_nielssenclima.png') }} " alt="nielssenclima logo" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_nomazul.gif') }} " alt="nomazul logo" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_papershispania.jpg') }} " alt="papershispania logo" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_pentrilo.png') }} " alt="pentrilo logo" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_procoel.jpg') }} " alt="procoel" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_ramossoler.png') }} " alt="ramos soler logo" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_regarsa.jpg') }} " alt="regarsa logo" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_riversa.jpg') }} " alt="riversa logo" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_rixaab.jpg') }} " alt="rixaab logo" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_roca.png') }} " alt="roca logo" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_rodman.gif') }} " alt="rodman logo" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_rothenberger.jpg') }} " alt="rothenberger logo" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_rubi.png') }} " alt="rubi logo" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_saunierduval.png') }} " alt="saunierduval logo" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_stilker.jpg') }} " alt="stilker logo" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_taconova.png') }} " alt="taconova logo" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_tejasborja.png') }} " alt="tejasborja logo" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_tmm.png') }} " alt="tmm logo" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_unecol.png') }} " alt="unecol logo" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_vilaralabaro.png') }} " alt="vilaralabaro logo" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_virax.png') }} " alt="virax logo" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_wirquin.jpg') }} " alt="wirquin logo" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-aco.png') }} " alt="aco logo" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-amiguet.png') }} " alt="amiguet logo" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-aparici.jpg') }} " alt="aparici logo" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-asnef.png') }} " alt="asnef logo" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-ath.png') }} " alt="ath logo" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-barrene.jpg') }} " alt="barrene logo" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-belianes.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-bellota.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-beyem.jpg') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-braseli.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-bur2000.jpg') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-cahors.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-cainox.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-ccalaf.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-cem.jpg') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-chova.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-cillit.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-clar.jpg') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-clever.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-courant.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-coycama.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-cpiera.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-cristher.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-dinuy.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-dopo.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-ducasa.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-elias.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-emac.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-fabregas.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-famatel.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-ferroplast.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/LOGO-FITTINGS.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-flexitub.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-frabo.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-gebo.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-genebre.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-gonal.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-greco.jpg') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-grohe.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-hecapo.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-hikoki.jpg') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-hisbalit.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-idealstandar.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-idral.jpg') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-ilumax.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-imex.jpg') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-indelux.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-indusmetal.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-infosa.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-irega.jpg') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-irsap.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-italsan.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-iverlux.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-jar.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-kaise.jpg') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-keraben.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-keros.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-knauf.jpg') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-kromschroeder.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-laescandella.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-lafac.jpg') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-lomar.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-martigrap.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-maydisa.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-miarco.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-miguelez.png') }} " alt="" width="120px" height="50p5">
            <img src=" {{ asset('img/logos proveedores/logo-molins.jpg') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-mundilite.jpg') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-natucer.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-navarti.jpg') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-nofer.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-novovent.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-nws.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-olfa.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-optor.jpg') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-orbis.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-orkli.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-paredes.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-placo.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-plastisan.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-ponsa.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-porcelagres.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-presto.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-puma.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-qp.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-resigres.jpg') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-Riuvert.jpg') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-rmm.jpg') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-rossini.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-ruko.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-sas.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-sfa.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-shureco.jpg') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-sika.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-simon.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-sofamel.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-solco.jpg') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-sorigue.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-stanley.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-sylvania.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-tejalapng.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-teka.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-televes.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-tercocer.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-tucai.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-verniprens.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-vikinga.jpg') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-watts.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-weber.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-witte.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-yilang.jpg') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/luxligth.jpg') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/maiol_logo.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/MT-business-key-logo.jpg') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/propamsa.jpg') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/roca.jpg') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/sanha.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/sika.jpg') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/solfless_logo.jpg') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/soprema.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/tayg.png') }} " alt="" width="120px" height="50px">
        </div>
    </div>

    <div id="add-proveedor-form" style="display:none;">
        <h4>Añadir Nueva Imagen de Proveedor</h4>
        <input type="file" id="new-proveedor-image" name="file" accept="image/*">
        <button id="add-proveedor-button">Añadir Imagen</button>
    </div>


    <x-footer />
    <script src="{{ asset('js/desplegable.js') }}"></script>
    <script src="{{ asset('js/footer.js') }}"></script>
    <script src="{{ asset('js/edit-proveedores.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js"></script>
    <script src="{{ asset('js/sortable.js') }}"></script>
    <script>
        const updateOrderUrl = "{{ route('images.updateOrder') }}";
    </script>
    <script>
        const addProveedorRoute = "{{ route('proveedores.addProveedor') }}";
        const csrfToken = "{{ csrf_token() }}";

        document.getElementById('edit-button').addEventListener('click', function() {
            document.querySelectorAll('.delete-form').forEach(form => {
                form.style.display = form.style.display === 'none' ? 'block' : 'none';
            });
            document.getElementById('add-image-form').style.display =
                document.getElementById('add-image-form').style.display === 'none' ? 'block' : 'none';
        });

        document.getElementById('add-image-button').addEventListener('click', function() {
            const fileInput = document.getElementById('new-image-file');
            const file = fileInput.files[0];

            if (file) {
                const formData = new FormData();
                formData.append('image', file);

                fetch('{{ route("images.upload") }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            const newDiv = document.createElement('div');
                            newDiv.className = 'image-item';
                            newDiv.setAttribute('data-id', data.id);

                            newDiv.innerHTML = `
                        <img src="${data.url}" alt="Nueva Imagen" style="max-width: 383px; height: 215px; margin: 10px; border-top: 1px solid #ffc106;">
                        <form action="/images/${data.id}" method="POST" class="delete-form" style="display:none;">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="delete-button">Eliminar</button>
                        </form>
                    `;
                            document.querySelector('.img-info').appendChild(newDiv);
                            fileInput.value = '';
                        } else {
                            alert(data.message || 'Error al subir la imagen');
                        }
                    })
                    .catch(error => console.error('Error:', error));
            } else {
                alert('Por favor, selecciona una imagen.');
            }
        });

        document.addEventListener('click', function(event) {
            if (event.target.classList.contains('delete-button')) {
                event.preventDefault();

                const deleteButton = event.target;
                const form = deleteButton.closest('.delete-form');
                const imageItem = deleteButton.closest('.image-item');
                const action = form.getAttribute('action');

                fetch(action, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            imageItem.remove();
                        } else {
                            alert(data.message || 'Error al eliminar la imagen.');
                        }
                    })
                    .catch(error => console.error('Error:', error));
            }
        });
    </script>

</body>

</html>