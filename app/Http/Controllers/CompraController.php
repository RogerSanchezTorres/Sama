<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CompraController extends Controller
{
    public function index()
    {
        if (auth()->check()) {
            return view('comprar.index');
        } else {
            return redirect()->route('login');
        }
    }
}
