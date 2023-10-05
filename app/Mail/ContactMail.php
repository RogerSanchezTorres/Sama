<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $datos;

    public function __construct($datos)
    {
        $this->datos = $datos;
    }


    public function build()
    {
        $mail = $this->view('emails.contacto')
            ->with([
                'nombre' => $this->datos['nombre'],
                'email' => $this->datos['email'],
                'mensaje' => $this->datos['mensaje'],
            ]);

        if (isset($this->datos['imagen'])) {
            $mail->attach($this->datos['imagen']->getRealPath(), [
                'as' => 'imagen.jpg',
            ]);
        }

        return $mail;
    }
}


/*namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $datos;

    public function __construct($datos)
    {
        $this->datos = $datos;
    }

    public function build()
    {
        return $this->from($this->datos['email'], $this->datos['nombre'])
            ->replyTo($this->datos['email'], $this->datos['nombre'])
            ->view('emails.contacto')
            ->subject('Nuevo mensaje de contacto');
    }
}*/
