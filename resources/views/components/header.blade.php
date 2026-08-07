<div id="header">
    <div class="enlaces">
        <div id="quienes-somos">
            <a href="{{ route('quienes-somos') }}">Quiénes Somos</a>
        </div>
        <div id="aviso-legal">
            <a href="{{ route('aviso-legal') }}">Aviso Legal</a>
        </div>
        <div id="contacto">
            <a href="{{ route('contacto') }}">Contacte con nosotros<a>
        </div>
    </div>

</div>

@if(App\Models\Setting::bannerEnabled())

<div class="top-banner {{ App\Models\Setting::bannerColor() }}">

    @if(App\Models\Setting::bannerTitle())
    <div class="banner-header">
        <div class="banner-title">
            {{ App\Models\Setting::bannerTitle() }}
        </div>
    </div>
    @endif

    <div class="banner-text">
        {!! nl2br(e(App\Models\Setting::bannerText())) !!}
    </div>

</div>

@endif


<style>
    #header a {
        color: #ffc106;
        margin-left: 30px;
        text-decoration: none;
    }

    #quienes-somos,
    #aviso-legal,
    #contacto {
        margin-top: 5px;
    }

    #header .enlaces {
        display: flex;
        margin-left: 270px;
    }


    .top-banner {
        width: 100%;
        box-sizing: border-box;

        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;

        padding: 16px 20px;

        border-top: 4px solid #ffc106;
        border-bottom: 1px solid rgba(0, 0, 0, .08);

        box-shadow: 0 2px 10px rgba(0, 0, 0, .08);

        animation: bannerFade .4s ease;
    }

    .banner-header {
        display: flex;
        align-items: center;
        gap: 10px;

        margin-bottom: 6px;
    }


    .banner-title {
        font-size: 14px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 3px;
    }

    .banner-text {
        text-align: center;
        white-space: pre-line;

        font-size: 17px;
        font-weight: 600;
        line-height: 1.6;
    }

    .top-banner.warning {

        background: #fff8df;
        color: #7a5b00;

    }

    .top-banner.info {

        background: #eef8ff;
        color: #005b85;

    }

    .top-banner.success {

        background: #eefcf2;
        color: #167d36;

    }

    .top-banner.danger {

        background: #fff1f1;
        color: #b32020;

    }

    @keyframes bannerFade {

        from {
            opacity: 0;
            transform: translateY(-10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }

    }
</style>