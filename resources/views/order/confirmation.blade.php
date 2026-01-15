<div style="max-width: 900px; margin: 100px auto; text-align: center;">

    {{-- Logo --}}
    <div style="margin-bottom:30px;">
        <img src="{{ asset('img/logo-web-negro.svg') }}" alt="Suministres Sama"
             style="max-width: 220px;">
    </div>

    {{-- Título --}}
    <h1 style="font-size: 32px; font-weight: 600; margin-bottom: 20px;">
        Pedido confirmado
    </h1>

    {{-- Mensaje principal --}}
    <p style="font-size: 18px; margin-bottom: 15px;">
        Gracias por confiar en <strong>Suministres Sama</strong>.
    </p>

    <p style="font-size: 16px; color: #555; margin-bottom: 30px;">
        Tu pago se ha realizado correctamente y tu pedido está siendo procesado.
    </p>

    {{-- Separador --}}
    <hr style="width: 120px; margin: 30px auto; border: 1px solid #f5c400;">

    {{-- Cuenta atrás --}}
    <p style="font-size: 16px; color: #444;">
        Serás redirigido automáticamente a la página principal en
        <strong><span id="countdown">5</span></strong> segundos.
    </p>

    {{-- Enlace manual --}}
    <p style="margin-top: 20px; font-size: 14px; color: #777;">
        Si no se produce la redirección,
        <a href="{{ route('index') }}" style="color: #f5c400; text-decoration: none;">
            haz clic aquí
        </a>.
    </p>
</div>

<script>
    let seconds = 5;
    const countdownElement = document.getElementById('countdown');

    const interval = setInterval(() => {
        seconds--;
        countdownElement.textContent = seconds;

        if (seconds <= 0) {
            clearInterval(interval);
            window.location.href = "{{ route('index') }}";
        }
    }, 1000);
</script>