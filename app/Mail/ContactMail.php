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
        $email = $this->from($this->datos['email'], $this->datos['nombre'])
            ->view('emails.contacto')
            ->replyTo($this->datos['email'], $this->datos['nombre'])
            ->subject('Nuevo mensaje de contacto');

        if (isset($this->datos['imagen'])) {
            $imagen = $this->datos['imagen'];
            $nombreImagen = $imagen->getClientOriginalName();
            $contenidoImagen = file_get_contents($imagen->getRealPath());

            $email->attachData($contenidoImagen, $nombreImagen, [
                'mime' => $imagen->getClientMimeType(),
            ]);
        }

        return $email;
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
