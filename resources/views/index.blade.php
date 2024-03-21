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

    <div class="img-info">
        <div id="simon">
            <img src="{{ asset('img/Simon.png') }}" alt="simon">
        </div>
        <div id="efapel">
            <img src="{{ asset('img/Efapel.png') }}" alt="efapel">
        </div>
        <div id="sanitarios">
            <img src="{{ asset('img/Sanitarios.png') }}" alt="sanitarios">
        </div>
    </div>

    <div id="proveedores">
        <div id="imagenes">
            <img src=" {{ asset('img/logos proveedores/3i_logo.png') }} " alt="3i_logo" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/Alsimet_logo.png') }} " alt="Alsimet" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/azuliber.png') }} " alt="azuliber" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/basor.png') }} " alt="basor" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/bayrol_logo.jpg') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/benadresa.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/braseli.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/calpeda_logo.JPG') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/Cemex-logo.jpg') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/Ceys.jpg') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/dake-cocinas.jpg') }} " alt="" width="120px" height="70px">
            <img src=" {{ asset('img/logos proveedores/DUNE_logo.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/fermax.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/gme_logo.gif') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/honeywell_logo_720x176.jpg') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/ílogo-dunlop.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/log-prhie.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo caleffi.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/Logo FAMATEL.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo plaza.jpg') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_adequa.jpg') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_ariston.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_askoll.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_azuliber.jpg') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_broquetas.jpg') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_celesa.jpg') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_ceramicaferres.jpg') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_ceramicasbelianes.jpg') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_cointra.jpg') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_comersin.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_crearplast.jpg') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_dajusa.jpg') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_dakota.jpg') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_dismol.jpg') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_efapel.jpg') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_emmeti.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_eskubi.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_exagres.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_ferroli.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_fig.jpg') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_firstiberica.jpg') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_fredimar.jpg') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_adequa.jpg') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_fujitsu.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_geminis.jpg') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_genwec.jpg') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/LOGO_GISCOSA.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/Logo_Henkel.jpg') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_hiyasu.jpg') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_inelca.jpg') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_isopipe.jpg') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_jimten.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_kapataz.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_laes.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_mapei.jpg') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_mediterraneadelbaño.jpg') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_mundilite.JPG') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_nielssenclima.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_nomazul.gif') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_papershispania.jpg') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_pentrilo.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_procoel.jpg') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_ramossoler.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_regarsa.jpg') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_riversa.jpg') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_rixaab.jpg') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_roca.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_rodman.gif') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_rothenberger.jpg') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_rubi.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_saunierduval.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_stilker.jpg') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_taconova.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_tejasborja.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_tmm.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_unecol.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_vilaralabaro.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_virax.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo_wirquin.jpg') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-aco.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-amiguet.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-aparici.jpg') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-asnef.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-ath.png') }} " alt="" width="120px" height="50px">
            <img src=" {{ asset('img/logos proveedores/logo-barrene.jpg') }} " alt="" width="120px" height="50px">
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

    <x-footer />

    <script src="{{ asset('js/desplegable.js') }}"></script>
    <script src="{{ asset('js/footer.js') }}"></script>
</body>

</html>