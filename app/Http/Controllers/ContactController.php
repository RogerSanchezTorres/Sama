<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ContactController extends Controller
{
    public function showContactForm()
    {
        return view('contacto');
    }

    public function enviarMensaje(Request $request)
    {
        $this->validate($request, [
            'nombre' => 'required',
            'email' => 'required|email',
            'mensaje' => 'required',
            'imagen' => 'nullable|file',
        ]);

        $datos = [
            'nombre' => $request->nombre,
            'email' => $request->email,
            'mensaje' => $request->mensaje,
        ];

        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $datos['imagen'] = $imagen;
        }

        Mail::to('r.sanchez2dawnuria2022@gmail.com')
            ->send(new ContactMail($datos));

        return back()->with('success', 'Mensaje enviado correctamente.');
    }

    /*public function enviarMensaje(Request $request)
    {
        $this->validate($request, [
            'nombre' => 'required',
            'email' => 'required|email',
            'mensaje' => 'required',
        ]);

        $datos = [
            'nombre' => $request->nombre,
            'email' => $request->email,
            'mensaje' => $request->mensaje,
        ];

        $correo = new ContactMail($datos);
        $correo->replyTo($datos['email'], $datos['nombre']);
        
        Mail::to('r.sanchez2dawnuria2022@gmail.com')->send($correo);

        return back()->with('success', 'Mensaje enviado correctamente.');
    }*/
}
