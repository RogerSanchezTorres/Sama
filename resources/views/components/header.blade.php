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

<style>
    #header a {
        color: #ffc106;
        margin-left: 30px;
        text-decoration: none;
    }

    #quienes-somos, #aviso-legal, #contacto {
        margin-top: 5px;
    }

    #header .enlaces {
        display: flex;
        margin-left: 270px;
    }
    
</style>