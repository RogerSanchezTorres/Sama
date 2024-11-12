<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Image;

class PageController extends Controller
{
    public function index()
    {
        $images = Image::all(); // Recupera todas las imágenes de la base de datos
        return view('index', compact('images')); // Carga la vista con las imágenes
    }
}
